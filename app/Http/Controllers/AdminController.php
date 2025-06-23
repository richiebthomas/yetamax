<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventAdmin;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller


{
    function jsonArrayToCsv($jsonArray) {
        // Decode the JSON string into a PHP array
        $array = json_decode($jsonArray, true);
    
        // Check if decoding was successful and the result is an array
        if (json_last_error() === JSON_ERROR_NONE && is_array($array)) {
            // Convert the array to a CSV string
            return implode(', ', $array);
        }
    
        // Return an empty string if the input is invalid
        return '';
    }
    
    public function dashboard(Request $request)
    {
        // Handle search by roll number
        $search = $request->input('search');
        
        // Base query for pending enrollments
        $pendingEnrollmentsQuery = Enrollment::where('approved', 0)
            ->with(['user', 'event', 'team'])
            ->orderBy('created_at', 'desc');
            
        // Base query for approved enrollments
        $approvedEnrollmentsQuery = Enrollment::where('approved', 1)
            ->with(['user', 'event', 'team'])
            ->orderBy('updated_at', 'desc');
            
        // Apply search filter if provided
        if ($search) {
            $userIds = User::where('roll_no', 'like', "%{$search}%")->pluck('id');
            
            $pendingEnrollmentsQuery->whereIn('user_id', $userIds);
            $approvedEnrollmentsQuery->whereIn('user_id', $userIds);
        }
        
        // Get paginated results
        $pendingEnrollments = $pendingEnrollmentsQuery->paginate(10, ['*'], 'pending_page');
        $approvedEnrollments = $approvedEnrollmentsQuery->paginate(10, ['*'], 'approved_page');
        
        // Handle search for events
        $eventSearch = $request->input('event_search');
        $eventsQuery = Event::orderBy('eventDay', 'asc')
            ->orderBy('startTime', 'asc');
        
        if ($eventSearch) {
            $eventsQuery->where('eventName', 'like', "%{$eventSearch}%");
        }
        
        // Get paginated events
        $events = $eventsQuery->paginate(10, ['*'], 'events_page');
            
        return view('admin.dashboard', [
            'events' => $events,
            'pendingEnrollments' => $pendingEnrollments,
            'approvedEnrollments' => $approvedEnrollments,
            'search' => $search,
            'eventSearch' => $eventSearch
        ]);
    }
    
    public function manageEventAdmins($eventId)
    {
        $event = Event::findOrFail($eventId);
        $eventAdmins = EventAdmin::where('event_id', $eventId)
            ->with('user')
            ->get();
            
        $users = User::where('is_super', false)->get();
        
        return view('admin.manage-event-admins', [
            'event' => $event,
            'eventAdmins' => $eventAdmins,
            'users' => $users
        ]);
    }
    
    public function assignEventAdmin(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'roll_number' => 'required|string|exists:users,roll_no',
        ]);
        
        // Find the event
        $event = Event::findOrFail($id);
        
        // Find the user by roll number
        $user = User::where('roll_no', $validated['roll_number'])->first();
        
        if (!$user) {
            return redirect()->back()->with('error', 'User with this roll number not found');
        }
        
        // Check if user is already an admin for this event
        $existingAdmin = EventAdmin::where('event_id', $id)
            ->where('user_id', $user->id)
            ->first();
            
        if ($existingAdmin) {
            return redirect()->back()->with('error', 'This user is already an admin for this event');
        }
        
        // Create new event admin
        EventAdmin::create([
            'event_id' => $id,
            'user_id' => $user->id
        ]);
        
        return redirect()->back()->with('success', 'Event admin assigned successfully');
    }
    
    public function removeEventAdmin($eventId, $userId)
    {
        EventAdmin::where('event_id', $eventId)
            ->where('user_id', $userId)
            ->delete();
            
        return redirect()->back()->with('success', 'Event admin removed successfully');
    }
    
    public function approveEnrollment($enrollmentId)
    {
        $enrollment = Enrollment::findOrFail($enrollmentId);
        
        // Begin transaction to ensure data consistency
        DB::beginTransaction();
        
        try {
            // Approve this enrollment
            $enrollment->approved = 1;
            $enrollment->save();
            
            // If this is a team member, approve enrollments for all team members
            if ($enrollment->team_id) {
                // Get all team members' enrollments
                Enrollment::where('team_id', $enrollment->team_id)
                    ->where('event_id', $enrollment->event_id)
                    ->update(['approved' => 1]);
            }
            
            DB::commit();
            return redirect()->back()->with('success', 'Enrollment approved successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to approve enrollment: ' . $e->getMessage());
        }
    }
    
    public function disapproveEnrollment($enrollmentId)
    {
        $enrollment = Enrollment::findOrFail($enrollmentId);
        
        // Begin transaction to ensure data consistency
        DB::beginTransaction();
        
        try {
            // Disapprove this enrollment
            $enrollment->approved = 0;
            $enrollment->save();
            
            // If this is a team member, disapprove enrollments for all team members
            if ($enrollment->team_id) {
                // Get all team members' enrollments
                Enrollment::where('team_id', $enrollment->team_id)
                    ->where('event_id', $enrollment->event_id)
                    ->update(['approved' => 0]);
            }
            
            DB::commit();
            return redirect()->back()->with('success', 'Enrollment disapproved successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to disapprove enrollment: ' . $e->getMessage());
        }
    }
} 
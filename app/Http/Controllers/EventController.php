<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Team;
use App\Models\User;

class EventController extends Controller
{

    public function index(Request $request)
    {
        if (!$request->has('day') || !$request->has('type')) {
            // Redirect with default values if missing
            return redirect()->route('allevents', [
                'day' => $request->get('day', 1),
                'type' => $request->get('type', 'technical'),
            ]);
        }
        // Get filter values from the request
        $day = $request->input('day');
        $type = $request->input('type');

        // Fetch events with optional filters
        $events = Event::when($day, function ($query, $day) {
            return $query->where('eventDay', $day);
        })->when($type, function ($query, $type) {
            return $query->where('eventCategory', $type);
        })->get();

        return view('allevents', [
            'events' => $events,
            'selectedDay' => $day,
            'selectedType' => $type
        ]);
    }


    public function show($id)
    {
        // Find the event by ID
        $event = Event::find($id);

        // Check if event exists
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        // Return event details view
        return view('event', ['event' => $event]);
    }

    public function enrollEvent($id, Request $request)
    {
        $event = Event::find($id);
        $user = auth()->user();
        
        // Get the team name from the request
        $teamName = $request->input('team_name');
        
        // For single-user enrollment
        if ($event->teamSize == 1) {
            // Create a team entry for the user
            $team = new Team();
            $team->user_id = $user->id;
            $team->event_id = $event->id;
            $team->name = null;
            $team->members = $user->roll_no; // Assuming user has a roll_no attribute
            
            if (!$team->save()) {
                return redirect()->back()->withErrors('Failed to create team.');
            }
            
            // Create enrollment for the user
            $enrollment = new Enrollment();
            $enrollment->user_id = $user->id;
            $enrollment->event_id = $event->id;
            $enrollment->team_id = $team->id;
            $enrollment->save();
        } 
        // For team enrollment
        else {
            // Get roll numbers from the request
            $rollNumbers = $request->input('roll_numbers', []);
            
            // Add the current user's roll number to the list
            array_unshift($rollNumbers, $user->roll_no);
            
            // Ensure we don't exceed the team size
            $rollNumbers = array_slice($rollNumbers, 0, $event->teamSize);
            
            // Validate that all roll numbers exist in the users table
            $invalidRollNumbers = [];
            foreach ($rollNumbers as $rollNumber) {
                if (!User::where('roll_no', $rollNumber)->exists()) {
                    $invalidRollNumbers[] = $rollNumber;
                }
            }
            
            // If there are invalid roll numbers, return with an error
            if (!empty($invalidRollNumbers)) {
                return redirect()->back()->withErrors('The following roll numbers do not exist: ' . implode(', ', $invalidRollNumbers));
            }
            
            // Check if any of the team members are already enrolled in this event
            $alreadyEnrolled = [];
            foreach ($rollNumbers as $rollNumber) {
                $teamMember = User::where('roll_no', $rollNumber)->first();
                if ($teamMember && Enrollment::where('user_id', $teamMember->id)->where('event_id', $event->id)->exists()) {
                    $alreadyEnrolled[] = $rollNumber;
                }
            }
            
            // If there are already enrolled members, return with an error
            if (!empty($alreadyEnrolled)) {
                return redirect()->back()->withErrors('The following team members are already enrolled in this event: ' . implode(', ', $alreadyEnrolled));
            }
            
            // First, create a master team record to get a shared team ID
            $masterTeam = new Team();
            $masterTeam->user_id = $user->id; // Team leader
            $masterTeam->event_id = $event->id;
            $masterTeam->name = $teamName;
            $masterTeam->members = json_encode($rollNumbers); // Store all members in the master team
            
            if (!$masterTeam->save()) {
                return redirect()->back()->withErrors('Failed to create team.');
            }
            
            // Now create enrollments for all team members using the same team_id
            foreach ($rollNumbers as $rollNumber) {
                // Find the user by roll number
                $teamMember = User::where('roll_no', $rollNumber)->first();
                
                // Create enrollment for this member
                $enrollment = new Enrollment();
                $enrollment->user_id = $teamMember->id;
                $enrollment->event_id = $event->id;
                $enrollment->team_id = $masterTeam->id; // Use the same team_id for all members
                $enrollment->save();
            }
        }
        
        return redirect()->back()->with('success', 'You have successfully enrolled in the event.');
    }

    public function unenrollEvent($id)
    {
        try {
            // Check if user is authenticated
            if (!auth()->check()) {
                return redirect('/')->with('failure', 'Please log in to unenroll from events.');
            }

            // Find the event
            $event = Event::find($id);
            if (!$event) {
                return redirect()->back()->withErrors('Event not found.');
            }

            $user = auth()->user();
            
            // Find the enrollment
            $enrollment = Enrollment::where('user_id', $user->id)
                                   ->where('event_id', $event->id)
                                   ->first();
            
            if (!$enrollment) {
                return redirect()->back()->withErrors('You are not enrolled in this event.');
            }

            // Check if enrollment is already approved
            if ($enrollment->approved) {
                return redirect()->back()->withErrors('Cannot unenroll from an approved event. Please contact the event administrator.');
            }
            
            try {
                // Begin transaction
                \DB::beginTransaction();

                // Get the team ID
                $teamId = $enrollment->team_id;
                
                // Find the team
                $team = Team::find($teamId);
                
                if ($team) {
                    // If it's a team enrollment (team size > 1)
                    if ($event->teamSize > 1) {
                        // Check if any team member's enrollment is approved
                        $approvedTeamEnrollments = Enrollment::where('team_id', $teamId)
                            ->where('approved', 1)
                            ->exists();
                        
                        if ($approvedTeamEnrollments) {
                            \DB::rollBack();
                            return redirect()->back()->withErrors('Cannot unenroll as one or more team members have approved enrollments.');
                        }

                        // For team leader validation
                        $teamMembers = $team->getTeamMembers();
                        if (!is_array($teamMembers) || empty($teamMembers) || $teamMembers[0] !== $user->roll_no) {
                            \DB::rollBack();
                            return redirect()->back()->withErrors('Only the team leader can unenroll the team.');
                        }
                        
                        // Delete all enrollments with this team_id
                        Enrollment::where('team_id', $teamId)->delete();
                        
                        // Delete the team
                        $team->delete();
                    } else {
                        // For single-user enrollment, just delete the enrollment and team
                        $enrollment->delete();
                        $team->delete();
                    }
                } else {
                    // If team not found, just delete the enrollment
                    $enrollment->delete();
                }

                \DB::commit();
                return redirect()->back()->with('success', 'You have successfully unenrolled from the event.');

            } catch (\Exception $e) {
                \DB::rollBack();
                \Log::error('Unenroll error: ' . $e->getMessage());
                return redirect()->back()->withErrors('An error occurred while unenrolling. Please try again later.');
            }

        } catch (\Exception $e) {
            \Log::error('Unenroll error: ' . $e->getMessage());
            return redirect()->back()->withErrors('An error occurred while processing your request. Please try again later.');
        }
    }
}

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

class EventAdminController extends Controller
{
    public function dashboard()
    {
        // Get all events where the current user is an admin
        $adminEvents = EventAdmin::where('user_id', auth()->id())
            ->with('event')
            ->get()
            ->pluck('event');
            
        return view('event-admin.dashboard', [
            'adminEvents' => $adminEvents
        ]);
    }
    
    public function manageEvent($eventId)
    {
        // Check if user is admin for this event
        if (!auth()->user()->isEventAdmin($eventId)) {
            return redirect('/')->with('error', 'You are not authorized to manage this event');
        }
        
        $event = Event::findOrFail($eventId);
        
        // Get all enrollments for this event
        $enrollments = Enrollment::where('event_id', $eventId)
            ->with(['user', 'team'])
            ->get();
            
        // Group enrollments by team
        $teams = [];
        $individualParticipants = [];
        
        foreach ($enrollments as $enrollment) {
            if ($enrollment->team_id) {
                if (!isset($teams[$enrollment->team_id])) {
                    $teams[$enrollment->team_id] = [
                        'team' => $enrollment->team,
                        'members' => []
                    ];
                }
                $teams[$enrollment->team_id]['members'][] = $enrollment->user;
            } else {
                $individualParticipants[] = $enrollment->user;
            }
        }
        
        return view('event-admin.manage', [
            'event' => $event,
            'teams' => $teams,
            'individualParticipants' => $individualParticipants
        ]);
    }
    
    public function editEvent($eventId)
    {
        // Check if user is admin for this event
        if (!auth()->user()->isEventAdmin($eventId)) {
            return redirect('/')->with('error', 'You are not authorized to edit this event');
        }
        
        $event = Event::findOrFail($eventId);
        
        return view('event-admin.edit', [
            'event' => $event
        ]);
    }
    
    public function updateEvent(Request $request, $eventId)
    {
        // Check if user is admin for this event
        if (!auth()->user()->isEventAdmin($eventId)) {
            return redirect('/')->with('error', 'You are not authorized to update this event');
        }
        
        $event = Event::findOrFail($eventId);
        
        $validated = $request->validate([
            'eventName' => 'required|string|max:255',
            'eventDetails' => 'required|string',
            'startTime' => 'required|string',
            'endTime' => 'required|string',
            'whatsapp' => 'nullable|url'
        ]);
        
        // Use DB::update to directly update the database without timestamps
        DB::table('events')
            ->where('id', $eventId)
            ->update([
                'eventName' => $validated['eventName'],
                'eventDetails' => $validated['eventDetails'],
                'startTime' => $validated['startTime'],
                'endTime' => $validated['endTime'],
                'whatsapp' => $validated['whatsapp']
            ]);
        
        return redirect()->route('event-admin.manage', $eventId)
            ->with('success', 'Event details updated successfully');
    }
} 
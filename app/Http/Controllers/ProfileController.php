<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Enrollment;
use App\Models\Team;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($roll_no)
    {
        // Find the user by roll number
        $user = User::where('roll_no', $roll_no)->firstOrFail();
        
        // Eager load enrollments with events and teams
        $enrollments = Enrollment::with(['event', 'team'])->where('user_id', $user->id)->get();
        
        // Group events by day
        $eventsByDay = [];
        
        foreach ($enrollments as $enrollment) {
            $event = $enrollment->event;
            
            if ($event) {
                $day = $event->eventDay;
                
                if (!isset($eventsByDay[$day])) {
                    $eventsByDay[$day] = [];
                }
                
                // Get team information
                $team = $enrollment->team;
                $teamInfo = null;
                
                if ($team) {
                    $teamInfo = [
                        'name' => $team->name,
                        'members' => []
                    ];
                    
                    // Get team members
                    $memberRollNumbers = $team->getTeamMembers();
                    
                    if (is_array($memberRollNumbers)) {
                        foreach ($memberRollNumbers as $rollNumber) {
                            $teamMember = User::where('roll_no', $rollNumber)->first();
                            if ($teamMember) {
                                $teamInfo['members'][] = [
                                    'roll_no' => $teamMember->roll_no,
                                    'name' => $teamMember->name
                                ];
                            }
                        }
                    }
                }
                
                $eventsByDay[$day][] = [
                    'event' => $event,
                    'team' => $teamInfo,
                    'is_approved' => $enrollment->approved
                ];
            }
        }
        
        // Sort days
        ksort($eventsByDay);
        
        return view('profile', [
            'user' => $user,
            'eventsByDay' => $eventsByDay
        ]);
    }
} 
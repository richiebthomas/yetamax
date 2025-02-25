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
        
        // Get all enrollments for the user
        $enrollments = Enrollment::where('user_id', $user->id)->get();
        
        // Group events by day
        $eventsByDay = [];
        
        foreach ($enrollments as $enrollment) {
            $event = Event::find($enrollment->event_id);
            
            if ($event) {
                $day = $event->eventDay;
                
                if (!isset($eventsByDay[$day])) {
                    $eventsByDay[$day] = [];
                }
                
                // Get team information
                $team = Team::find($enrollment->team_id);
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
                    'team' => $teamInfo
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
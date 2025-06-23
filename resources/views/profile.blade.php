<x-layout>
    <div class="container py-5">
        <div class="row">
            <!-- User Information Card -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="avatar-placeholder mb-3">
                                <i class="fas fa-user fa-3x text-muted"></i>
                            </div>
                            <h2 class="card-title mb-0">{{ $user->name }}</h2>
                            <p class="text-muted">{{ $user->roll_no }}</p>
                        </div>
                        
                        <div class="user-details">
                            <div class="detail-item d-flex align-items-center mb-3">
                                <div class="icon-container mr-3">
                                    <i class="fas fa-envelope text-primary"></i>
                                </div>
                                <div>
                                    <p class="detail-label mb-0 small text-muted">Email</p>
                                    <p class="detail-value mb-0">{{ $user->email }}</p>
                                </div>
                            </div>
                            
                            <div class="detail-item d-flex align-items-center mb-3">
                                <div class="icon-container mr-3">
                                    <i class="fas fa-calendar-check text-success"></i>
                                </div>
                                <div>
                                    <p class="detail-label mb-0 small text-muted">Events Enrolled</p>
                                    <p class="detail-value mb-0">{{ $totalEnrollments }}</p>
                                </div>
                            </div>

                            @if($totalFees > 0)
                                <div class="detail-item d-flex align-items-center mb-3">
                                    <div class="icon-container mr-3">
                                        <i class="fas fa-rupee-sign text-warning"></i>
                                    </div>
                                    <div>
                                        <p class="detail-label mb-0 small text-muted">Total Pending Fees</p>
                                        <p class="detail-value mb-0">₹{{ $totalFees }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Events Section -->
            <div class="col-lg-8">
                <h3 class="mb-4">Enrolled Events</h3>
                
                @if(count($eventsByDay) > 0)
                    @foreach($eventsByDay as $day => $events)
                        <div class="day-section mb-4">
                            <h4 class="day-heading">
                                <span class="day-badge">Day {{ $day }}</span>
                            </h4>
                            
                            <div class="row">
                                @foreach($events as $eventData)
                                    <div class="col-md-6 mb-4">
                                        <div class="event-card h-100">
                                            
                                            <div class="event-status">
                                                @if($eventData['is_approved'])
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-warning">Pending</span>
                                                @endif
                                            </div>
                                            
                                            <div class="event-header">
                                                <h5 class="event-title">
                                                    <i class="fas fa-calendar-alt mr-2"></i>
                                                    {{ $eventData['event']->eventName }}
                                                </h5>
                                                <div class="event-badge">{{ $eventData['event']->eventCategory }}</div>
                                            </div>
                                            
                                            
                                            <div class="event-body">
                                                <div class="event-detail">
                                                    <i class="fas fa-map-marker-alt text-danger mr-2"></i>
                                                    <span>Day {{ $eventData['event']->eventDay }}</span>
                                                </div>
                                                
                                                
                                                <div class="event-detail">
                                                    <i class="fas fa-clock text-info mr-2"></i>
                                                    <span>{{ $eventData['event']->startTime }}</span> - <span>{{ $eventData['event']->endTime }}</span>
                                                </div>
                                                
                                                <div class="event-detail">
                                                    <i class="fas fa-rupee-sign text-success mr-2"></i>
                                                    <span>
                                                        @if($eventData['event']->teamSize > 1)
                                                            @if($eventData['team'] && $user->roll_no !== $eventData['team']['members'][0]['roll_no'])
                                                                <span class="text-muted">To be paid by team leader</span>
                                                            @else
                                                                Entry Fees: ₹{{ $eventData['event']->entryFees }}
                                                            @endif
                                                        @else
                                                            Entry Fees: ₹{{ $eventData['event']->entryFees }}
                                                        @endif
                                                    </span>
                                                </div>
                                                
                                                @if($eventData['team'])
                                                    <div class="team-info mt-3">
                                                        @if($eventData['team']['name'])
                                                            <div class="team-name mb-2">
                                                                <i class="fas fa-users text-primary mr-2"></i>
                                                                <strong>Team:</strong> {{ $eventData['team']['name'] }}
                                                            </div>
                                                        @endif
                                                        
                                                        @if(count($eventData['team']['members']) > 1)
                                                            <div class="team-members">
                                                                <strong>Members:</strong>
                                                                <ul class="list-unstyled ml-3 mb-0">
                                                                    @foreach($eventData['team']['members'] as $index => $member)
                                                                        <li>
                                                                            <i class="fas fa-user-circle text-secondary mr-1"></i>
                                                                            {{ $member['name'] }} ({{ $member['roll_no'] }})
                                                                            @if($index === 0)
                                                                                <span class="badge badge-info">Team Leader</span>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                            
                                            <div class="event-footer">
                                                <a href="/event/{{ $eventData['event']->id }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-info-circle mr-1"></i> View Details
                                                </a>
                                                
                                                @if($eventData['is_approved'])
                                                    <div class="event-detail">
                                                        <div class="detail-content">
                                                            <label class="detail-label"></label>
                                                            <div class="detail-value">
                                                                <a href="{{ $eventData['event']->whatsapp }}" target="_blank" class="btn btn-sm btn-success whatsapp-link">
                                                                    <i class="fab fa-whatsapp me-1"></i>
                                                                    Join WhatsApp Group
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <form action="/unenroll/{{ $eventData['event']->id }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-times me-1"></i>
                                                            Unenroll
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-2"></i>
                        No events enrolled yet.
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <style>

        
        /* User Card Styles */
        .avatar-placeholder {
            width: 100px;
            height: 100px;
            background-color: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }
        
        .icon-container {
            width: 40px;
            height: 40px;
            background-color: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Day Section Styles */
        .day-heading {
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 0.5rem;
        }
        
        .day-badge {
            background-color: #4361ee;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }
        
        /* Event Card Styles */
        .event-card {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
            border: 2px solid #021014; /* Cool blue outline */
            background-color: white; /* Keep the card itself white */
            
            
        }
        
        .event-card:hover {
            
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .event-header {
            padding: 1rem;
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .event-title {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .event-badge {
            background-color: #4cc9f0;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.8rem;
        }
        
        .event-body {
            padding: 1rem;
            flex-grow: 1;
        }
        
        .event-detail {
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }
        
        .team-info {
            background-color: #f8f9fa;
            padding: 0.75rem;
            border-radius: 4px;
            margin-top: 1rem;
        }
        
        .event-footer {
            padding: 1rem;
            border-top: 1px solid #e9ecef;
            background-color: #f8f9fa;
        }
        
        /* Status Indicator Styles */
        .status-indicator {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        
        .badge {
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .badge-success {
            background-color: #28a745;
            color: white;
        }
        
        .badge-warning {
            background-color: #ffc107;
            color: black;
        }
        
        .badge-info {
            background-color: #3b82f6;
            color: white;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            margin-left: 0.5rem;
        }
        
        .text-success {
            color: #10b981;
        }
        
        .text-muted {
            color: #6b7280;
            font-style: italic;
        }
        /* Set the page background to cool blue */
body {
    background-color: #e0f2ff; /* Light cool blue */
}



    </style>
</x-layout>

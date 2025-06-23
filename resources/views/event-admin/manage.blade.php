<x-layout>
    <div class="container py-5">
        <div class="admin-header">
            <h1 class="admin-title">Manage Event: {{ $event->eventName }}</h1>
            <div class="admin-actions">
                <a href="{{ route('event-admin.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
                <a href="{{ route('event-admin.edit', $event->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Event Details
                </a>
            </div>
        </div>
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="event-details-card">
            <div class="card-section">
                <h2 class="section-title">Event Information</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Category</span>
                        <span class="info-value">{{ $event->eventCategory }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Day</span>
                        <span class="info-value">{{ $event->eventDay }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Time</span>
                        <span class="info-value">{{ $event->startTime }} - {{ $event->endTime }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Venue</span>
                        <span class="info-value">{{ $event->eventVenue }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Entry Fees</span>
                        <span class="info-value">₹{{ $event->entryFees }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Team Size</span>
                        <span class="info-value">{{ $event->teamSize }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Max Seats</span>
                        <span class="info-value">{{ $event->maxSeats }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Enrolled</span>
                        <span class="info-value">{{ count($teams) + count($individualParticipants) }}</span>
                    </div>
                </div>
            </div>
            
            <div class="card-section">
                <h2 class="section-title">Event Details</h2>
                <div class="event-description">
                    {!! $event->eventDetails !!}
                </div>
            </div>
        </div>
        
        <div class="participants-section">
            <h2 class="section-title">Participants</h2>
            
            @if(count($teams) > 0 || count($individualParticipants) > 0)
                @if(count($teams) > 0)
                    <div class="teams-container">
                        <h3 class="subsection-title">Teams</h3>
                        
                        <div class="teams-grid">
                            @foreach($teams as $teamId => $teamData)
                                <div class="team-card">
                                    <div class="team-header">
                                        <h4 class="team-name">{{ $teamData['team']->name ?? 'Team ' . $teamId }}</h4>
                                        <span class="team-size">{{ count($teamData['members']) }} members</span>
                                    </div>
                                    <div class="team-members">
                                        @foreach($teamData['members'] as $member)
                                            <div class="team-member">
                                                <div class="member-avatar">
                                                    {{ substr($member->name, 0, 1) }}
                                                </div>
                                                <div class="member-info">
                                                    <span class="member-name">{{ $member->name }}</span>
                                                    <span class="member-roll">{{ $member->roll_no }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                @if(count($individualParticipants) > 0)
                    <div class="individuals-container">
                        <h3 class="subsection-title">Individual Participants</h3>
                        
                        <div class="individuals-grid">
                            @foreach($individualParticipants as $participant)
                                <div class="individual-card">
                                    <div class="individual-avatar">
                                        {{ substr($participant->name, 0, 1) }}
                                    </div>
                                    <div class="individual-info">
                                        <span class="individual-name">{{ $participant->name }}</span>
                                        <span class="individual-roll">{{ $participant->roll_no }}</span>
                                        <span class="individual-email">{{ $participant->email }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <i class="fas fa-users-slash"></i>
                    <h3>No Participants Yet</h3>
                    <p>There are no participants enrolled in this event yet.</p>
                </div>
            @endif
        </div>
    </div>
    
    <style>
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .admin-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2563eb;
            margin: 0;
        }
        
        .admin-actions {
            display: flex;
            gap: 0.75rem;
        }
        
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary {
            background: #2563eb;
            color: white;
        }
        
        .btn-primary:hover {
            background: #1d4ed8;
        }
        
        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
        }
        
        .btn-secondary:hover {
            background: #e5e7eb;
        }
        
        .event-details-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 2rem;
        }
        
        .card-section {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .card-section:last-child {
            border-bottom: none;
        }
        
        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 1.5rem;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
        }
        
        .info-label {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 0.25rem;
        }
        
        .info-value {
            font-size: 1rem;
            font-weight: 500;
            color: #374151;
        }
        
        .event-description {
            color: #4b5563;
            line-height: 1.6;
        }
        
        .participants-section {
            margin-top: 2rem;
        }
        
        .subsection-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .teams-grid, .individuals-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .team-card, .individual-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .team-header {
            padding: 1rem;
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .team-name {
            font-size: 1.125rem;
            font-weight: 600;
            margin: 0;
        }
        
        .team-size {
            font-size: 0.875rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
        }
        
        .team-members, .individual-info {
            padding: 1rem;
        }
        
        .team-member {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .team-member:last-child {
            border-bottom: none;
        }
        
        .member-avatar, .individual-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }
        
        .member-info {
            display: flex;
            flex-direction: column;
        }
        
        .member-name, .individual-name {
            font-weight: 500;
            color: #374151;
        }
        
        .member-roll, .individual-roll, .individual-email {
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .individual-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
        }
        
        .individual-info {
            display: flex;
            flex-direction: column;
            padding: 0;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .empty-state i {
            font-size: 3rem;
            color: #d1d5db;
            margin-bottom: 1rem;
        }
        
        .empty-state h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #374151;
        }
        
        .empty-state p {
            color: #6b7280;
        }
        
        @media (max-width: 768px) {
            .admin-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .teams-grid, .individuals-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</x-layout> 
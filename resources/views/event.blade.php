<x-layout>
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="container py-5">
        <!-- Error Messages Section -->
        @if(session('errors') || session('success'))
        <div class="alert-container mb-4">
            @if(session('errors'))
                @foreach(session('errors')->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @endif
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        @endif
        <!-- End Error Messages Section -->

        <div class="event-card">
            <div class="event-badge">{{ $event->eventCategory }}</div>
            <div class="event-header">
                <h1 class="event-title">
                    <i class="fas fa-calendar-alt me-2"></i>{{ $event->eventName }}
                </h1>
                
            </div>
            
            <div class="event-body">
                <div class="event-detail">
                    <i class="fas fa-info-circle detail-icon"></i>
                    <div class="detail-content">
                        <label class="detail-label">Event Details</label>
                        <div class="detail-value">{!! $event->eventDetails !!}</div>
                    </div>
                </div>

                <div class="detail-grid">
                    <div class="event-detail">
                        <i class="fas fa-rupee-sign detail-icon"></i>
                        <div class="detail-content">
                            <label class="detail-label">Entry Fees</label>
                            <div class="detail-value">₹{{ $event->entryFees }}</div>
                        </div>
                    </div>

                    <div class="event-detail">
                        <i class="fas fa-users detail-icon"></i>
                        <div class="detail-content">
                            <label class="detail-label">Team Size</label>
                            <div class="detail-value">{{ $event->teamSize }}</div>
                        </div>
                    </div>

                    <div class="event-detail">
                        <i class="fas fa-chair detail-icon"></i>
                        <div class="detail-content">
                            <label class="detail-label">Available Seats</label>
                            <div class="detail-value">{{ $event->maxSeats - ($event->enrollments()->count() ? $event->enrollments()->count() - ($event->teamSize - 1) : 0)  }}</div>
                        </div>
                    </div>

                    <div class="event-detail">
                        <i class="fas fa-clock detail-icon"></i>
                        <div class="detail-content">
                            <label class="detail-label">Time</label>
                            <div class="detail-value">{{ $event->startTime }} - {{ $event->endTime }}</div>
                        </div>
                    </div>

                    <div class="event-detail">
                        <i class="fas fa-calendar-day detail-icon"></i>
                        <div class="detail-content">
                            <label class="detail-label">Event Day</label>
                            <div class="detail-value">{{ $event->eventDay }}</div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="event-footer">
                @if(auth()->user()->enrollments()->where('event_id', $event->id)->where('approved', 1)->exists())
                You cannot unenroll as your enrollment has been approved
                @elseif(auth()->user()->enrollments()->where('event_id', $event->id)->exists())
                <form action="/unenroll/{{ $event->id }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger enroll-link">
                        <i class="fas fa-times-circle me-2"></i>Unenroll
                    </button>
                </form>
                
                @else
                <form action="/enroll/{{ $event->id }}" method="POST">
                    @csrf
                    @if($event->teamSize > 1)
                        <div class="team-members-form">
                            
                            <label for="team-name">Team Name :</label>
                            
                            <input type="text" name="team_name" id="team-name" class="form-control mb-3" placeholder="Enter team name">
                            <div class="mb-3"> Member 1: {{ auth()->user()->roll_no }}</div>
                            @for($i = 1; $i < $event->teamSize; $i++)
                                <label for="roll-number-{{ $i }}">Member {{ $i+1 }}:</label>
                                <input type="text" name="roll_numbers[]" id="roll-number-{{ $i }}" class="form-control mb-3" placeholder="Enter roll number">
                            @endfor
                        </div>
                    @endif
                    <button type="submit" class="btn btn-success enroll-link" {{ $event->maxSeats - ($event->enrollments ? $event->enrollments->count() : 0) <= 0 ? 'disabled' : '' }}>
                        <i class="fas fa-check-circle me-2"></i>
                        @if($event->maxSeats - ($event->enrollments ? $event->enrollments->count() : 0) > 0)
                            Enroll Now
                        @else
                            Full
                        @endif
                    </button>
                </form>
                @endif
            </div>

            <div class="event-footer">
                <a href="{{ route('allevents') }}" class="back-link">
                    <i class="fas fa-arrow-left me-2"></i>Back to Events
                </a>
            </div>
        </div>
    </div>
</x-layout>

<style>
    :root {
        --primary-color: #2563eb;
        --primary-dark: #1d4ed8;
        --secondary-color: #4f46e5;
        --text-color: #374151;
        --border-radius: 12px;
        --spacing-sm: 0.75rem;
        --spacing-md: 1.5rem;
        --spacing-lg: 2.5rem;
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .container {
        width: 100%;
        padding: var(--spacing-md);
        max-width: none;
    }

    .event-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        padding: var(--spacing-lg);
        margin: 0 auto;
        position: relative;
    }

    .event-image-container {
        margin: -2.5rem -2.5rem 2rem;
        height: 400px;
        position: relative;
        overflow: hidden;
        border-radius: var(--border-radius) var(--border-radius) 0 0;
    }

    .event-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .event-header {
        text-align: center;
        padding-bottom: var(--spacing-md);
        margin-bottom: var(--spacing-md);
        border-bottom: 2px solid #e5e7eb;
        position: relative;
    }

    .event-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-color);
        margin-bottom: var(--spacing-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .event-badge {
        position: absolute;
        top: -16px;
        right: -8px;
        background: var(--primary-color);
        color: white;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
        box-shadow: var(--shadow);
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: var(--spacing-md);
        margin-top: var(--spacing-md);
    }

    .event-detail {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 8px;
        transition: transform 0.2s ease;
    }

    .event-detail:hover {
        transform: translateY(-2px);
        background: #f1f5f9;
    }

    .detail-icon {
        font-size: 1.5rem;
        color: var(--primary-color);
        min-width: 32px;
        text-align: center;
        margin-top: 4px;
    }

    .detail-label {
        display: block;
        font-size: 0.875rem;
        color: #64748b;
        margin-bottom: 0.25rem;
        font-weight: 500;
    }

    .detail-value {
        font-size: 1rem;
        color: var(--text-color);
        font-weight: 500;
        line-height: 1.4;
    }

    .whatsapp-link {
        color: #25d366 !important;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s ease;
    }

    .whatsapp-link:hover {
        color: #128C7E !important;
        transform: translateX(4px);
    }

    .event-footer {
        margin-top: var(--spacing-lg);
        border-top: 2px solid #e5e7eb;
        padding-top: var(--spacing-md);
        text-align: center;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        background: var(--primary-color);
        color: white !important;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
        font-weight: 500;
    }

    .back-link:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    @media (max-width: 768px) {
        .container {
            padding: 0.5rem;
        }
        
        .event-card {
            padding: var(--spacing-md);
            margin: 0;
            border-radius: 0;
        }
        
        .event-image-container {
            margin: -1rem -1rem 1rem;
            height: 250px;
            border-radius: 0;
        }
        
        .detail-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .event-title {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .event-image-container {
            height: 200px;
        }
        
        .event-detail {
            padding: 0.75rem;
        }
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s ease;
        text-decoration: none;
        color: white;
    }

    .btn-success {
        background-color: var(--primary-color);
    }

    .btn-success:hover {
        background-color: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .btn-danger {
        background-color: #e3342f;
    }

    .btn-danger:hover {
        background-color: #cc1f1a;
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .btn:disabled {
        background-color: #6c757d;
        cursor: not-allowed;
    }

    .team-members-form {
        margin-bottom: 1rem;
    }

    .form-control {
        width: 100%;
        padding: 0.5rem;
        margin-bottom: 0.5rem;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    /* Alert styles */
    .alert-container {
        width: 100%;
        max-width: none;
        padding: 0 var(--spacing-md);
    }

    .alert {
        padding: 1rem;
        border-radius: var(--border-radius);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        position: relative;
    }

    .alert-success {
        background-color: #d1e7dd;
        color: #0f5132;
        border: 1px solid #badbcc;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #842029;
        border: 1px solid #f5c2c7;
    }

    .btn-close {
        position: absolute;
        right: 1rem;
        top: 1rem;
        background: transparent;
        border: none;
        font-size: 1.25rem;
        cursor: pointer;
        opacity: 0.5;
    }

    .btn-close:hover {
        opacity: 1;
    }
</style>
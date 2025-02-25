<x-layout>
    <div class="container py-5">
        <div class="admin-header">
            <h1 class="admin-title">Event Admin Dashboard</h1>
            <p class="admin-subtitle">Manage your assigned events</p>
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
        
        <div class="admin-events">
            @if($adminEvents->count() > 0)
                <div class="row">
                    @foreach($adminEvents as $event)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="admin-event-card">
                                <div class="event-card-header">
                                    <h3 class="event-name">{{ $event->eventName }}</h3>
                                    <span class="event-category">{{ $event->eventCategory }}</span>
                                </div>
                                <div class="event-card-body">
                                    <div class="event-info">
                                        <div class="info-item">
                                            <i class="fas fa-calendar-day"></i>
                                            <span>Day {{ $event->eventDay }}</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-clock"></i>
                                            <span>{{ $event->startTime }} - {{ $event->endTime }}</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>{{ $event->eventVenue }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="event-card-footer">
                                    <a href="{{ route('event-admin.manage', $event->id) }}" class="btn btn-primary">
                                        <i class="fas fa-cog"></i> Manage Event
                                    </a>
                                    <a href="{{ route('event-admin.edit', $event->id) }}" class="btn btn-secondary">
                                        <i class="fas fa-edit"></i> Edit Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-calendar-times"></i>
                    <h3>No Events Assigned</h3>
                    <p>You haven't been assigned as an admin for any events yet.</p>
                </div>
            @endif
        </div>
    </div>
    
    <style>
        .admin-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .admin-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2563eb;
            margin-bottom: 0.5rem;
        }
        
        .admin-subtitle {
            color: #6b7280;
            font-size: 1.1rem;
        }
        
        .admin-event-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .admin-event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .event-card-header {
            padding: 1.5rem;
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: white;
        }
        
        .event-name {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .event-category {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            font-size: 0.875rem;
        }
        
        .event-card-body {
            padding: 1.5rem;
            flex-grow: 1;
        }
        
        .event-info {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .info-item i {
            color: #2563eb;
            width: 20px;
            text-align: center;
        }
        
        .event-card-footer {
            padding: 1.5rem;
            border-top: 1px solid #e5e7eb;
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
    </style>
</x-layout> 
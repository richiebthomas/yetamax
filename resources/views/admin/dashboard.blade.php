<x-layout>
    <div class="container py-5">
        <div class="admin-header">
            <h1 class="admin-title">Admin Dashboard</h1>
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
        
        <!-- Search Form for Enrollments -->
        <div class="admin-section">
            <form action="{{ route('admin.dashboard') }}" method="GET" class="search-form">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by Roll Number..." value="{{ $search ?? '' }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Pending Enrollments Section -->
        <div class="admin-section">
            <div class="section-header">
                <h2 class="section-title">Pending Enrollments</h2>
            </div>
            
            @if($pendingEnrollments->count() > 0)
                <div class="enrollments-table-container">
                    <table class="enrollments-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Event</th>
                                <th>Day</th>
                                <th>Type</th>
                                <th>Fees</th>
                                <th>Team members</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingEnrollments as $enrollment)
                                @if($enrollment->event->teamSize <= 1 || $enrollment->user->isTeamLeader($enrollment->team_id))
                                    <tr>
                                        <td>
                                            <div class="user-info">
                                                <span class="user-name">{{ $enrollment->user->name }}</span>
                                                <span class="user-roll">{{ $enrollment->user->roll_no }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $enrollment->event->eventName }}</td>
                                        <td>Day {{ $enrollment->event->eventDay }}</td>
                                        <td>{{ $enrollment->event->eventCategory }}</td>
                                        <td>₹{{ $enrollment->event->entryFees }}</td>
                                        <td>{{ $enrollment->team->members[0] == "[" ? $enrollment->team->members : 'Individual' }}</td>
                                        <td>
                                            <form action="{{ route('admin.enrollments.approve', $enrollment->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fas fa-check"></i> Approve
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination-container">
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($pendingEnrollments->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">Previous</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $pendingEnrollments->previousPageUrl() }}">Previous</a></li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($pendingEnrollments->getUrlRange(1, $pendingEnrollments->lastPage()) as $page => $url)
                            @if ($page == $pendingEnrollments->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($pendingEnrollments->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $pendingEnrollments->nextPageUrl() }}">Next</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">Next</span></li>
                        @endif
                    </ul>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-check-circle"></i>
                    <h3>No Pending Enrollments</h3>
                    <p>All enrollments have been processed or none match your search.</p>
                </div>
            @endif
        </div>
        
        <!-- Approved Enrollments Section -->
        <div class="admin-section">
            <div class="section-header">
                <h2 class="section-title">Approved Enrollments</h2>
            </div>
            
            @if($approvedEnrollments->count() > 0)
                <div class="enrollments-table-container">
                    <table class="enrollments-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Event</th>
                                <th>Day</th>
                                <th>Fees</th>
                                <th>Event Type</th>
                                <th>Team members</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($approvedEnrollments as $enrollment)
                                @if($enrollment->event->teamSize <= 1 || $enrollment->user->isTeamLeader($enrollment->team_id))
                                    <tr>
                                        <td>
                                            <div class="user-info">
                                                <span class="user-name">{{ $enrollment->user->name }}</span>
                                                <span class="user-roll">{{ $enrollment->user->roll_no }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $enrollment->event->eventName }}</td>
                                        <td>Day {{ $enrollment->event->eventDay }}</td>
                                        <td>₹{{ $enrollment->event->entryFees }}</td>
                                        <td>{{ $enrollment->event->eventCategory }}</td>
                                        <td>{{ $enrollment->team->members[0] == "[" ? $enrollment->team->members : 'Individual' }}</td>
                                        <td>
                                            <form action="{{ route('admin.enrollments.disapprove', $enrollment->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-times"></i> Disapprove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination-container">
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($approvedEnrollments->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">Previous</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $approvedEnrollments->previousPageUrl() }}">Previous</a></li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($approvedEnrollments->getUrlRange(1, $approvedEnrollments->lastPage()) as $page => $url)
                            @if ($page == $approvedEnrollments->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($approvedEnrollments->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $approvedEnrollments->nextPageUrl() }}">Next</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">Next</span></li>
                        @endif
                    </ul>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-receipt"></i>
                    <h3>No Approved Enrollments</h3>
                    <p>All enrollments have been processed or none match your search.</p>
                </div>
            @endif
        </div>
        
        <!-- Manage Events Section -->
        <div class="admin-section">
            <div class="section-header">
                <h2 class="section-title">Manage Events</h2>
            </div>
            
            <!-- Search Form for Events -->
            <form action="{{ route('admin.dashboard') }}" method="GET" class="search-form">
                <div class="input-group">
                    <input type="text" name="event_search" class="form-control" placeholder="Search by Event Name..." value="{{ $eventSearch ?? '' }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </div>
            </form>
            
            <div class="events-table-container">
                <table class="events-table">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Category</th>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $event->eventName }}</td>
                                <td>{{ $event->eventCategory }}</td>
                                <td>Day {{ $event->eventDay }}</td>
                                <td>{{ $event->startTime }} - {{ $event->endTime }}</td>
                                <td>
                                    <a href="{{ route('admin.event.admins', $event->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-users-cog"></i> Manage Admins
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-container">
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($events->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">Previous</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $events->previousPageUrl() }}">Previous</a></li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($events->getUrlRange(1, $events->lastPage()) as $page => $url)
                        @if ($page == $events->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($events->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $events->nextPageUrl() }}">Next</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">Next</span></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    
    <style>
        .admin-header {
            margin-bottom: 2rem;
        }
        
        .admin-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2563eb;
        }
        
        .admin-section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #374151;
            margin: 0;
        }
        
        .search-form {
            margin-bottom: 1rem;
        }
        
        .input-group {
            display: flex;
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 6px 0 0 6px;
            width: 100%;
        }
        
        .input-group-append {
            display: flex;
        }
        
        .input-group-append .btn {
            border-radius: 0 6px 6px 0;
        }
        
        .enrollments-table-container, .events-table-container {
            overflow-x: auto;
        }
        
        .enrollments-table, .events-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .enrollments-table th, .enrollments-table td,
        .events-table th, .events-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .enrollments-table th, .events-table th {
            background-color: #f9fafb;
            font-weight: 600;
            color: #4b5563;
        }
        
        .enrollments-table tr:hover, .events-table tr:hover {
            background-color: #f9fafb;
        }
        
        .user-info {
            display: flex;
            flex-direction: column;
        }
        
        .user-name {
            font-weight: 500;
            color: #111827;
        }
        
        .user-roll {
            font-size: 0.875rem;
            color: #6b7280;
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
        
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
        
        .btn-primary {
            background: #2563eb;
            color: white;
        }
        
        .btn-primary:hover {
            background: #1d4ed8;
        }
        
        .btn-success {
            background: #10b981;
            color: white;
        }
        
        .btn-success:hover {
            background: #059669;
        }
        
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        
        .btn-danger:hover {
            background: #dc2626;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
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
        
        .pagination-container {
            margin-top: 1.5rem;
            display: flex;
            justify-content: center;
        }
        
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 1rem 0;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .pagination li {
            margin: 0;
        }
        
        .pagination li a, .pagination li span {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 36px;
            min-width: 36px;
            padding: 0 12px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            color: #374151;
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            transition: background-color 0.3s ease;
        }
        
        .pagination li.active span {
            color: white;
            background-color: #2563eb;
            border-color: #2563eb;
        }
        
        .pagination li a:hover {
            background-color: #e5e7eb;
        }
        
        .pagination li.disabled span {
            color: #9ca3af;
            pointer-events: none;
            background-color: #f3f4f6;
        }
    </style>
</x-layout> 
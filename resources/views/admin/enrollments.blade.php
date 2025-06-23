<x-layout>
    <div class="container py-5">
        <div class="admin-header">
            <h1 class="admin-title">Manage Enrollments</h1>
            <div class="admin-actions">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
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
        
        <!-- Pending Enrollments Section -->
        <div class="admin-section">
            <h2 class="section-title">Pending Enrollments</h2>
            
            @if($pendingEnrollments->count() > 0)
                <div class="enrollments-table-container">
                    <table class="enrollments-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Event</th>
                                <th>Team</th>
                                <th>Transaction ID</th>
                                <th>Payment Method</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingEnrollments as $enrollment)
                                <tr>
                                    <td>
                                        <div class="user-info">
                                            <span class="user-name">{{ $enrollment->user->name }}</span>
                                            <span class="user-roll">{{ $enrollment->user->roll_no }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $enrollment->event->eventName }}</td>
                                    <td>{{ $enrollment->team_id ? $enrollment->team->teamName : 'Individual' }}</td>
                                    <td>{{ $enrollment->transaction_id ?? 'Not provided' }}</td>
                                    <td>{{ $enrollment->payment_method ?? 'Not specified' }}</td>
                                    <td>{{ $enrollment->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <form action="{{ route('admin.enrollments.approve', $enrollment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i> Approve
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-check-circle"></i>
                    <h3>No Pending Enrollments</h3>
                    <p>All enrollments have been processed.</p>
                </div>
            @endif
        </div>
        
        <!-- Approved Enrollments Section -->
        <div class="admin-section">
            <h2 class="section-title">Approved Enrollments</h2>
            
            @if($approvedEnrollments->count() > 0)
                <div class="enrollments-table-container">
                    <table class="enrollments-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Event</th>
                                <th>Team</th>
                                <th>Transaction ID</th>
                                <th>Payment Method</th>
                                <th>Date Approved</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($approvedEnrollments as $enrollment)
                                <tr>
                                    <td>
                                        <div class="user-info">
                                            <span class="user-name">{{ $enrollment->user->name }}</span>
                                            <span class="user-roll">{{ $enrollment->user->roll_no }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $enrollment->event->eventName }}</td>
                                    <td>{{ $enrollment->team_id ? $enrollment->team->teamName : 'Individual' }}</td>
                                    <td>{{ $enrollment->transaction_id ?? 'Not provided' }}</td>
                                    <td>{{ $enrollment->payment_method ?? 'Not specified' }}</td>
                                    <td>{{ $enrollment->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="pagination-container">
                    {{ $approvedEnrollments->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-receipt"></i>
                    <h3>No Approved Enrollments</h3>
                    <p>No enrollments have been approved yet.</p>
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
        
        .admin-section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 1.5rem;
        }
        
        .enrollments-table-container {
            overflow-x: auto;
        }
        
        .enrollments-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .enrollments-table th, .enrollments-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .enrollments-table th {
            background-color: #f9fafb;
            font-weight: 600;
            color: #4b5563;
        }
        
        .enrollments-table tr:hover {
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
        
        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
        }
        
        .btn-secondary:hover {
            background: #e5e7eb;
        }
        
        .btn-success {
            background: #10b981;
            color: white;
        }
        
        .btn-success:hover {
            background: #059669;
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
    </style>
</x-layout> 
<x-layout>
    <div class="container py-5">
        <div class="admin-header">
            <h1 class="admin-title">Manage Event Admins: {{ $event->eventName }}</h1>
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
        
        <div class="admin-section">
            <h2 class="section-title">Current Event Admins</h2>
            
            @if($eventAdmins->count() > 0)
                <div class="admins-list">
                    @foreach($eventAdmins as $admin)
                        <div class="admin-card">
                            <div class="admin-info">
                                <div class="admin-avatar">
                                    {{ substr($admin->user->name, 0, 1) }}
                                </div>
                                <div class="admin-details">
                                    <h3 class="admin-name">{{ $admin->user->name }}</h3>
                                    <p class="admin-roll">{{ $admin->user->roll_no }}</p>
                                    <p class="admin-email">{{ $admin->user->email }}</p>
                                </div>
                            </div>
                            <form action="{{ route('admin.event.admins.remove', ['eventId' => $event->id, 'userId' => $admin->user->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-users-slash"></i>
                    <h3>No Event Admins</h3>
                    <p>There are no admins assigned to this event yet.</p>
                </div>
            @endif
        </div>
        
        <div class="admin-section">
            <h2 class="section-title">Assign New Admin</h2>
            
            <form action="{{ route('admin.event.admins.assign', $event->id) }}" method="POST" class="assign-form">
                @csrf
                <div class="form-group">
                    <label for="roll_number">Enter Roll Number</label>
                    <div class="input-group">
                        <input type="text" id="roll_number" name="roll_number" class="form-control" placeholder="Enter student roll number" required>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-user-plus"></i> Add Admin
                            </button>
                        </div>
                    </div>
                    @error('roll_number')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </form>
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
        
        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
        }
        
        .btn-secondary:hover {
            background: #e5e7eb;
        }
        
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        
        .btn-danger:hover {
            background: #dc2626;
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
        
        .admins-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        
        .admin-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background-color: #f9fafb;
        }
        
        .admin-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .admin-avatar {
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
        
        .admin-name {
            font-size: 1rem;
            font-weight: 600;
            color: #374151;
            margin: 0;
        }
        
        .admin-roll, .admin-email {
            font-size: 0.875rem;
            color: #6b7280;
            margin: 0;
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
        
        .assign-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        label {
            font-weight: 500;
            color: #374151;
        }
        
        .form-control {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
            outline: none;
        }
        
        .input-group {
            display: flex;
            width: 100%;
        }
        
        .input-group-append {
            display: flex;
        }
        
        .input-group .form-control {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            flex: 1;
        }
        
        .input-group-append .btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        
        .text-danger {
            color: #ef4444;
            font-size: 0.875rem;
        }
        
        @media (max-width: 768px) {
            .admins-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</x-layout> 
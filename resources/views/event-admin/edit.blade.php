<x-layout>
    <div class="container py-5">
        <div class="admin-header">
            <h1 class="admin-title">Edit Event: {{ $event->eventName }}</h1>
            <div class="admin-actions">
                <a href="{{ route('event-admin.manage', $event->id) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Event
                </a>
            </div>
        </div>
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        <div class="edit-form-container">
            <form action="{{ route('event-admin.update', $event->id) }}" method="POST" class="edit-form">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="eventName">Event Name</label>
                    <input type="text" id="eventName" name="eventName" class="form-control" value="{{ old('eventName', $event->eventName) }}" required>
                    @error('eventName')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="eventDetails">Event Details</label>
                    <textarea id="eventDetails" name="eventDetails" class="form-control" rows="6" required>{{ old('eventDetails', $event->eventDetails) }}</textarea>
                    @error('eventDetails')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-row">
                    <div class="form-group half">
                        <label for="startTime">Start Time</label>
                        <input type="time" id="startTime" name="startTime" class="form-control" value="{{ old('startTime', $event->startTime) }}" required>
                        @error('startTime')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group half">
                        <label for="endTime">End Time</label>
                        <input type="time" id="endTime" name="endTime" class="form-control" value="{{ old('endTime', $event->endTime) }}" required>
                        @error('endTime')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="whatsapp">WhatsApp Group Link (Optional)</label>
                    <input type="url" id="whatsapp" name="whatsapp" class="form-control" value="{{ old('whatsapp', $event->whatsapp) }}">
                    @error('whatsapp')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
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
        
        .edit-form-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }
        
        .edit-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .form-row {
            display: flex;
            gap: 1.5rem;
        }
        
        .half {
            flex: 1;
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
        
        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 1rem;
        }
        
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 1.5rem;
            }
        }
    </style>
</x-layout> 
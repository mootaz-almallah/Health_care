@extends('layouts.admin.app')

@section('header')
Users
@endsection

@section('content')

<style>
    /* Search bar styles */
.input-group {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 4px;
    overflow: hidden;
}

.input-group .form-control {
    border-right: none;
    padding: 10px 15px;
    height: auto;
}

.input-group .btn {
    padding: 10px 20px;
    border-left: none;
    transition: all 0.3s ease;
}

.input-group .btn:hover {
    opacity: 0.9;
}

.input-group .btn-outline-secondary {
    border-left: 1px solid #ddd;
}
</style>


<!-- Add this line to include the CSS -->
<link rel="stylesheet" href="{{ asset('css/dashboard.style.css') }}">
<div class="container">

    <!-- Search Bar Section -->
    <div class="row mb-4">
        <div class="col-md-12">
            <form action="{{ route('users.index') }}" method="GET">
                <div class="input-group">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search by name, email, or phone..."
                           value="{{ request('search') }}"
                           aria-label="Search">
                    <button class="btn" style="background-color: #e12454; color: white;" type="submit">
                        <i class="fas fa-search"></i> Search
                    </button>
                    @if(request('search'))
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Button to trigger the "Add User" modal -->
    {{-- <div class="d-flex justify-content-end mb-3">
        <button type="button"class="btn" style="background-color: #e12454; color: white;" data-bs-toggle="modal" data-bs-target="#addUserModal">
            Add User
        </button>
    </div> --}}

    <table class="dashboard-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <!-- Edit Button (triggers modal) -->
                            <button type="button" class="btn btn-primary p-2" data-bs-toggle="modal" data-bs-target="#editModal-{{ $user->id }}">
                                Edit
                            </button>

                            <!-- Delete Button (triggers modal) -->
                            <button type="button" class="btn btn-danger p-2" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $user->id }}">
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Edit Form Modal -->
                <div class="modal fade" id="editModal-{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel-{{ $user->id }}">Edit User: {{ $user->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name-{{ $user->id }}" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name-{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email-{{ $user->id }}" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email-{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone-{{ $user->id }}" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone-{{ $user->id }}" name="phone" value="{{ $user->phone }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password-{{ $user->id }}" class="form-label">New Password (Optional)</label>
                                        <input type="password" class="form-control" id="password-{{ $user->id }}" name="password" placeholder="Leave blank to keep current password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation-{{ $user->id }}" class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control" id="password_confirmation-{{ $user->id }}" name="password_confirmation" placeholder="Confirm new password">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteModal-{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel-{{ $user->id }}">Confirm Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete user "{{ $user->name }}" ({{ $user->email }})? This action cannot be undone.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4 d-flex justify-content-center">
        {{ $users->links() }}
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add this to initialize select2 if you're using it for permissions multiselect -->
@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Select2 for permissions in both Add and Edit modals
        $('select[name="permissions[]"]').select2({
            theme: 'bootstrap-5',
            placeholder: 'Select permissions',
            allowClear: true
        });
    });
</script>
@endpush

@endsection

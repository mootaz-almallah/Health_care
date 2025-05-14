@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">My Appointments</h4>
                    @auth
                        <a href="{{ route('appointments.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Appointment
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Appointment
                        </a>
                    @endauth
                </div>

                <div class="card-body">
                    @if($appointments->isEmpty())
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <h5>No Appointments Found</h5>
                            <p class="text-muted">You haven't booked any appointments yet.</p>
                            @auth
                                <a href="{{ route('appointments.create') }}" class="btn btn-primary mt-3">
                                    <i class="fas fa-plus"></i> Book Your First Appointment
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary mt-3">
                                    <i class="fas fa-plus"></i> Book Your First Appointment
                                </a>
                            @endauth
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Doctor</th>
                                        <th>Specialization</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                        <tr>
                                            <td>{{ $appointment->appointment_date }}</td>
                                            <td>{{ $appointment->appointment_time }}</td>
                                            <td>{{ $appointment->doctor->name }}</td>
                                            <td>{{ $appointment->doctor->specialization->name }}</td>
                                            <td>
                                                <span class="badge bg-{{ $appointment->status === 'confirmed' ? 'success' : ($appointment->status === 'pending' ? 'warning' : 'danger') }}">
                                                    {{ ucfirst($appointment->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if($appointment->status === 'pending')
                                                        <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
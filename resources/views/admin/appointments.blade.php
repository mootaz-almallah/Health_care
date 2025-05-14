@extends('layouts.admin.app')

@section('header')
Appointments
@endsection

@section('content')

<!-- Add this line to include the CSS -->
<link rel="stylesheet" href="{{ asset('css/dashboard.style.css') }}">

<div class="container">
    <table class="dashboard-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Date</th>
                <th>Status</th>
                <th>Payment Status</th>
                <!-- <th>Actions</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $appointment->patient?->name ?? 'Walk-in' }}</td>
                    <td>{{ $appointment->doctor->name }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>{{ $appointment->status }}</td>
                    <td>{{ $appointment->payment_status }}</td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal-{{ $appointment->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $appointment->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel-{{ $appointment->id }}">Edit Appointment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal-{{ $appointment->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $appointment->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel-{{ $appointment->id }}">Confirm Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this appointment? This action cannot be undone.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4 d-flex justify-content-center">
        {{ $appointments->links() }}
    </div>
</div>

@endsection
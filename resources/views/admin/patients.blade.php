@extends('layouts.admin.app')

@section('header')
Patients
@endsection

@section('content')

<!-- Add this line to include the CSS -->
<link rel="stylesheet" href="{{ asset('css/dashboard.style.css') }}">

<div class="container">
    <table class="dashboard-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->phone }}</td>
                </tr>               
            @endforeach
        </tbody>
    </table>
    <div class="mt-4 d-flex justify-content-center">
        {{ $patients->links() }}
    </div>
</div>

@endsection
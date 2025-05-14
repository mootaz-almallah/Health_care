@extends('layouts.admin.app')

@section('header')
Subscriptions
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.style.css') }}">

<div class="container">
    <table class="dashboard-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Doctor Name</th>
                <th>Subscription Start Date</th>
                <th>Subscription End Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subscriptions as $subscription)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $subscription->doctor->name ?? 'Not Available' }}</td>
                    <td>{{ $subscription->start_date }}</td>
                    <td>{{ $subscription->end_date }}</td>
                    <td>{{ $subscription->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

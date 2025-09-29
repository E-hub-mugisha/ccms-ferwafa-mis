@extends('layouts.app')
@section('content')
<!-- ✅ Dashboard Content -->
<div class="container my-4">
    <h2 class="mb-4">Welcome, {{ Auth::user()->name ?? 'Admin' }} 👋</h2>

    <!-- ✅ Statistics Row -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-shield-fill display-5 text-primary"></i>
                    <h5 class="mt-3">Total Clubs</h5>
                    <h3 class="fw-bold">{{ $clubsCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-people-fill display-5 text-success"></i>
                    <h5 class="mt-3">Players</h5>
                    <h3 class="fw-bold">{{ $playersCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-person-badge display-5 text-warning"></i>
                    <h5 class="mt-3">Staff</h5>
                    <h3 class="fw-bold">{{ $staffCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-arrow-left-right display-5 text-danger"></i>
                    <h5 class="mt-3">Transfers</h5>
                    <h3 class="fw-bold">{{ $transfersCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- ✅ Quick Actions -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-lightning-charge"></i> Quick Actions
        </div>
        <div class="card-body">
            <a href="{{ route('clubs.create') }}" class="btn btn-outline-primary btn-sm m-1"><i class="bi bi-plus-circle"></i> Add Club</a>
            <a href="{{ route('players.create') }}" class="btn btn-outline-success btn-sm m-1"><i class="bi bi-person-plus"></i> Add Player</a>
            <a href="{{ route('fixtures.create') }}" class="btn btn-outline-warning btn-sm m-1"><i class="bi bi-calendar-plus"></i> Create Fixture</a>
            <a href="{{ route('player_transfers.create') }}" class="btn btn-outline-danger btn-sm m-1"><i class="bi bi-arrow-repeat"></i> Record Transfer</a>
        </div>
    </div>

    <!-- ✅ Recent Activity -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <i class="bi bi-clock-history"></i> Recent Activities
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @forelse($recentActivities ?? [] as $activity)
                <li class="list-group-item">
                    <i class="bi bi-dot"></i> {{ $activity }}
                </li>
                @empty
                <li class="list-group-item text-muted">No recent activities available.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
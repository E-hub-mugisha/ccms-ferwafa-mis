@extends('layouts.user')

@section('content')
<!-- Hero Section -->
<div class="hero overlay" style="background-image: url('{{ asset('images/bg_3.jpg') }}');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mx-auto text-center">
                <h1 class="text-white">Football Clubs</h1>
                <p>Explore our league’s amazing clubs and their history.</p>
            </div>
        </div>
    </div>
</div>

<!-- Clubs Grid -->
<div class="site-section">
    <div class="container">
        <div class="row">
            @forelse($clubs as $club)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="club-card text-center shadow-sm p-3 bg-white rounded">
                        <!-- Club Logo -->
                        <img src="{{ $club->logo ? asset('storage/'.$club->logo) : asset('images/default-club.png') }}"
                             alt="{{ $club->name }}"
                             class="img-fluid mb-3"
                             style="width:120px;height:120px;object-fit:cover;">

                        <!-- Club Name -->
                        <h5 class="mb-1">{{ $club->name }}</h5>

                        <!-- City & Country -->
                        <p class="text-muted small mb-1">
                            @if($club->city) {{ $club->city }}, @endif {{ $club->country }}
                        </p>

                        <!-- Founded Year -->
                        @if($club->founded_year)
                            <small class="d-block text-secondary">
                                Founded: {{ $club->founded_year }}
                            </small>
                        @endif

                        <!-- Player Count -->
                        <span class="badge bg-primary mt-2">
                            {{ $club->players_count }} Players
                        </span>

                        <!-- Optional stadium -->
                        @if($club->stadium)
                            <p class="mt-2 mb-0"><i class="bi bi-building"></i> {{ $club->stadium }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No clubs found.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $clubs->links() }}
        </div>
    </div>
</div>
@endsection

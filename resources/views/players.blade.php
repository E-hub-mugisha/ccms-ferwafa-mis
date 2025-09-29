@extends('layouts.user')

@section('content')
<!-- Hero Section -->
<div class="hero overlay" style="background-image: url('../images/bg_3.jpg');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mx-auto text-center">
                <h1 class="text-white">Players</h1>
                <p>Meet our talented football players.</p>
            </div>
        </div>
    </div>
</div>

<!-- Players Grid -->
<div class="site-section">
    <div class="container">
        <div class="row">
            @forelse($players as $player)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="player-card text-center shadow-sm p-3 bg-white rounded">
                    <!-- Player Photo -->
                    <img src="{{ $player->photo ? asset('storage/'.$player->photo) : asset('images/default-player.jpg') }}"
                        alt="{{ $player->first_name }} {{ $player->last_name }}"
                        class="img-fluid rounded-circle mb-3"
                        style="width:150px;height:150px;object-fit:cover;">

                    <!-- Name -->
                    <h5 class="mb-1">{{ $player->first_name }} {{ $player->last_name }}</h5>

                    <!-- Position -->
                    <p class="text-muted mb-1">{{ $player->position }}</p>

                    <!-- Club -->
                    @if($player->club)
                    <span class="badge bg-primary text-white">{{ $player->club->name }}</span>
                    @endif

                    <!-- Nationality -->
                    @if($player->nationality)
                    <p class="mt-2 mb-0"><i class="bi bi-flag"></i> {{ $player->nationality }}</p>
                    @endif

                    <!-- Birth Date -->
                    @if($player->birth_date)
                    <small class="d-block text-secondary">
                        Born: {{ \Carbon\Carbon::parse($player->birth_date)->format('F j, Y') }}
                    </small>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>No players found.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <div class="custom-pagination">
                    <a href="#">1</a>
                    <span>2</span>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.user')
@section('title', 'Home')
@section('content')

<div class="hero overlay" style="background-image: url('images/bg_3.jpg');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 ml-auto">
                <h3 class="text-white">{{ config('app.name')}}</h3>
                <p>The Club Central Management System (CCMS) is a digital platform developed to transform how football clubs under the Rwanda Football Federation (FERWAFA) manage their operations</p>
                <p>
                    <a href="{{ route('login') }}" class="btn btn-primary py-3 px-4 mr-3">Login</a>
                    <a href="{{ route('register') }}" class="more light">Register</a>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            @if($recentMatch)
            <div class="d-flex team-vs">
                {{-- Final Score --}}
                <span class="score">
                    {{ $recentMatch->home_score }} - {{ $recentMatch->away_score }}
                </span>

                {{-- Team 1 --}}
                <div class="team-1 w-50">
                    <div class="team-details w-100 text-center">
                        <img src="{{ asset('storage/'.$recentMatch->homeClub->logo) }}" alt="{{ $recentMatch->homeClub->name }}" class="img-fluid">
                        <h3>
                            {{ strtoupper($recentMatch->homeClub->name) }}
                            <span>
                                ({{ $recentMatch->winner === 'homeClub' ? 'win' : ($recentMatch->winner === 'draw' ? 'draw' : 'loss') }})
                            </span>
                        </h3>
                    </div>
                </div>

                {{-- Team 2 --}}
                <div class="team-2 w-50">
                    <div class="team-details w-100 text-center">
                        <img src="{{ asset('storage/'.$recentMatch->awayClub->logo) }}" alt="{{ $recentMatch->awayClub->name }}" class="img-fluid">
                        <h3>
                            {{ strtoupper($recentMatch->awayClub->name) }}
                            <span>
                                ({{ $recentMatch->winner === 'awayClub' ? 'win' : ($recentMatch->winner === 'draw' ? 'draw' : 'loss') }})
                            </span>
                        </h3>
                    </div>
                </div>
            </div>

            {{-- Optional match meta --}}
            <div class="text-center mt-3">
                <strong>Date:</strong> {{ $recentMatch->match_date->format('F jS, Y g:i A') }}<br>
                <strong>Venue:</strong> {{ $recentMatch->venue->name ?? 'TBA' }}
            </div>
            @else
            <p class="text-center">No recent matches available.</p>
            @endif
        </div>
    </div>
</div>

<div class="site-section bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="widget-next-match">
                    <div class="widget-title">
                        <h3>Next Match</h3>
                    </div>

                    @if($nextMatch)
                    <div class="widget-body mb-3">
                        <div class="widget-vs">
                            <div class="d-flex align-items-center justify-content-around justify-content-between w-100">
                                <div class="team-1 text-center">
                                    <img src="{{ asset('storage/'.$nextMatch->homeClub->logo) }}" alt="{{ $nextMatch->homeClub->name }}" class="img-fluid" style="max-height:80px">
                                    <h3>{{ $nextMatch->homeClub->name }}</h3>
                                </div>
                                <div>
                                    <span class="vs"><span>VS</span></span>
                                </div>
                                <div class="team-2 text-center">
                                    <img src="{{ asset('storage/'.$nextMatch->awayClub->logo) }}" alt="{{ $nextMatch->awayClub->name }}" class="img-fluid" style="max-height:80px">
                                    <h3>{{ $nextMatch->awayClub->name }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center widget-vs-contents mb-4">
                        <h4>{{ $nextMatch->league->name ?? 'Friendly Match' }}</h4>
                        <p class="mb-5">
                            <span class="d-block">{{ $nextMatch->match_date->format('F jS, Y') }}</span>
                            <span class="d-block">{{ $nextMatch->match_date->format('g:i A T') }}</span>
                            <strong class="text-primary">{{ $nextMatch->venue->name ?? 'TBA' }}</strong>
                        </p>

                        {{-- Countdown container --}}
                        <div id="date-countdown2" class="pb-1"
                            data-date="{{ $nextMatch->match_date->format('Y-m-d H:i:s') }}">
                        </div>
                    </div>
                    @else
                    <p class="text-center mb-4">No upcoming match scheduled.</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">

                <div class="widget-next-match">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>P</th>
                                <th>Team</th>
                                <th>W</th>
                                <th>D</th>
                                <th>L</th>
                                <th>PTS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $clubs as $club)
                            <tr>
                                <td>{{ $club->id }}</td>
                                <td><strong class="text-white">{{ $club->name }}</strong></td>
                                <td>22</td>
                                <td>3</td>
                                <td>2</td>
                                <td>140</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div> <!-- .site-section -->

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
    </div>
</div>
@endsection
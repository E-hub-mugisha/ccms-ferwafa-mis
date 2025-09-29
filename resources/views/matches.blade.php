@extends('layouts.user')
@section('content')

<div class="hero overlay" style="background-image: url('../images/bg_3.jpg');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mx-auto text-center">
                <h1 class="text-white">Matches</h1>
                <p>All recent and upcoming matches in one place.</p>
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

        <div class="row mb-5">
            <div class="col-lg-12">
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
        </div>

        <div class="row">
            <div class="col-12 title-section">
                <h2 class="heading">Upcoming Match</h2>
            </div>

            @forelse($matches as $match)
            <div class="col-lg-6 mb-4">
                <div class="bg-light p-4 rounded">
                    <div class="widget-body">
                        <div class="widget-vs">
                            <div class="d-flex align-items-center justify-content-around justify-content-between w-100">
                                <div class="team-1 text-center">
                                    <img src="{{ asset('storage/'.$match->homeClub->logo) }}" alt="{{ $match->homeClub->name }}" class="img-fluid" style="max-height:80px">
                                    <h3>{{ $match->homeClub->name }}</h3>
                                </div>
                                <div>
                                    <span class="vs"><span>VS</span></span>
                                </div>
                                <div class="team-2 text-center">
                                    <img src="{{ asset('storage/'.$match->awayClub->logo) }}" alt="{{ $match->awayClub->name }}" class="img-fluid" style="max-height:80px">
                                    <h3>{{ $match->awayClub->name }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center widget-vs-contents mb-4">
                        <h4>{{ $match->league->name ?? 'Friendly Match' }}</h4>
                        <p class="mb-5">
                            <span class="d-block">{{ $match->match_date->format('F jS, Y') }}</span>
                            <span class="d-block">{{ $match->match_date->format('g:i A T') }}</span>
                            <strong class="text-primary">{{ $match->venue ?? 'TBA' }}</strong>
                        </p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center">No upcoming matches available.</p>
            </div>
            @endforelse
        </div>

    </div>
</div> <!-- .site-section -->


@endsection
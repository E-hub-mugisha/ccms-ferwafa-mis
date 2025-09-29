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

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-6 title-section">
                <h2 class="heading">Videos</h2>
            </div>
            <div class="col-6 text-right">
                <div class="custom-nav">
                    <a href="#" class="js-custom-prev-v2"><span class="icon-keyboard_arrow_left"></span></a>
                    <span></span>
                    <a href="#" class="js-custom-next-v2"><span class="icon-keyboard_arrow_right"></span></a>
                </div>
            </div>
        </div>


        <div class="owl-4-slider owl-carousel">
            <div class="item">
                <div class="video-media">
                    <img src="images/img_1.jpg" alt="Image" class="img-fluid">
                    <a href="https://vimeo.com/139714818" class="d-flex play-button align-items-center" data-fancybox>
                        <span class="icon mr-3">
                            <span class="icon-play"></span>
                        </span>
                        <div class="caption">
                            <h3 class="m-0">Dogba set for Juvendu return?</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="video-media">
                    <img src="images/img_2.jpg" alt="Image" class="img-fluid">
                    <a href="https://vimeo.com/139714818" class="d-flex play-button align-items-center" data-fancybox>
                        <span class="icon mr-3">
                            <span class="icon-play"></span>
                        </span>
                        <div class="caption">
                            <h3 class="m-0">Kai Nets Double To Secure Comfortable Away Win</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="video-media">
                    <img src="images/img_3.jpg" alt="Image" class="img-fluid">
                    <a href="https://vimeo.com/139714818" class="d-flex play-button align-items-center" data-fancybox>
                        <span class="icon mr-3">
                            <span class="icon-play"></span>
                        </span>
                        <div class="caption">
                            <h3 class="m-0">Romolu to stay at Real Nadrid?</h3>
                        </div>
                    </a>
                </div>
            </div>

            <div class="item">
                <div class="video-media">
                    <img src="images/img_1.jpg" alt="Image" class="img-fluid">
                    <a href="https://vimeo.com/139714818" class="d-flex play-button align-items-center" data-fancybox>
                        <span class="icon mr-3">
                            <span class="icon-play"></span>
                        </span>
                        <div class="caption">
                            <h3 class="m-0">Dogba set for Juvendu return?</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="video-media">
                    <img src="images/img_2.jpg" alt="Image" class="img-fluid">
                    <a href="https://vimeo.com/139714818" class="d-flex play-button align-items-center" data-fancybox>
                        <span class="icon mr-3">
                            <span class="icon-play"></span>
                        </span>
                        <div class="caption">
                            <h3 class="m-0">Kai Nets Double To Secure Comfortable Away Win</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="video-media">
                    <img src="images/img_3.jpg" alt="Image" class="img-fluid">
                    <a href="https://vimeo.com/139714818" class="d-flex play-button align-items-center" data-fancybox>
                        <span class="icon mr-3">
                            <span class="icon-play"></span>
                        </span>
                        <div class="caption">
                            <h3 class="m-0">Romolu to stay at Real Nadrid?</h3>
                        </div>
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>

<div class="container site-section">
    <div class="row">
        <div class="col-6 title-section">
            <h2 class="heading">Our Blog</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="custom-media d-flex">
                <div class="img mr-4">
                    <img src="images/img_1.jpg" alt="Image" class="img-fluid">
                </div>
                <div class="text">
                    <span class="meta">May 20, 2020</span>
                    <h3 class="mb-4"><a href="#">Romolu to stay at Real Nadrid?</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus deserunt saepe tempora dolorem.</p>
                    <p><a href="#">Read more</a></p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="custom-media d-flex">
                <div class="img mr-4">
                    <img src="images/img_3.jpg" alt="Image" class="img-fluid">
                </div>
                <div class="text">
                    <span class="meta">May 20, 2020</span>
                    <h3 class="mb-4"><a href="#">Romolu to stay at Real Nadrid?</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus deserunt saepe tempora dolorem.</p>
                    <p><a href="#">Read more</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
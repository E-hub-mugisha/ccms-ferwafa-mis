@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Match & Fixture Management</h3>

    <!-- Button trigger modal -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addMatchModal">
        Add New Match
    </button>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Home</th>
                <th>Away</th>
                <th>Date</th>
                <th>Venue</th>
                <th>Status</th>
                <th>Score</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matches as $match)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $match->homeClub->name }}</td>
                <td>{{ $match->awayClub->name }}</td>
                <td>{{ $match->match_date }}</td>
                <td>{{ $match->venue }}</td>
                <td>{{ $match->status }}</td>
                <td>
                    @if($match->status == 'Played')
                        {{ $match->home_score }} - {{ $match->away_score }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewMatchModal{{ $match->id }}">View</button>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editMatchModal{{ $match->id }}">Edit</button>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteMatchModal{{ $match->id }}">Delete</button>
                </td>
            </tr>

            <!-- View Modal -->
            <div class="modal fade" id="viewMatchModal{{ $match->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header"><h5 class="modal-title">Match Info</h5></div>
                        <div class="modal-body">
                            <p><strong>Home:</strong> {{ $match->homeClub->name }}</p>
                            <p><strong>Away:</strong> {{ $match->awayClub->name }}</p>
                            <p><strong>Date:</strong> {{ $match->match_date }}</p>
                            <p><strong>Venue:</strong> {{ $match->venue }}</p>
                            <p><strong>Status:</strong> {{ $match->status }}</p>
                            <p><strong>Score:</strong>
                                @if($match->status == 'Played')
                                    {{ $match->home_score }} - {{ $match->away_score }}
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editMatchModal{{ $match->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('matches.update', $match->id) }}" class="modal-content">
                        @csrf @method('PUT')
                        <div class="modal-header"><h5 class="modal-title">Edit Match</h5></div>
                        <div class="modal-body">
                            <div class="mb-2">
                                <label>Home Club</label>
                                <select name="home_club_id" class="form-control" required>
                                    @foreach($clubs as $club)
                                        <option value="{{ $club->id }}" @if($match->home_club_id == $club->id) selected @endif>{{ $club->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label>Away Club</label>
                                <select name="away_club_id" class="form-control" required>
                                    @foreach($clubs as $club)
                                        <option value="{{ $club->id }}" @if($match->away_club_id == $club->id) selected @endif>{{ $club->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2"><label>Date</label>
                                <input type="date" name="match_date" value="{{ $match->match_date }}" class="form-control" required>
                            </div>
                            <div class="mb-2"><label>Venue</label>
                                <input type="text" name="venue" value="{{ $match->venue }}" class="form-control" required>
                            </div>
                            <div class="mb-2"><label>Home Score</label>
                                <input type="number" name="home_score" value="{{ $match->home_score }}" class="form-control">
                            </div>
                            <div class="mb-2"><label>Away Score</label>
                                <input type="number" name="away_score" value="{{ $match->away_score }}" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="Scheduled" @if($match->status == 'Scheduled') selected @endif>Scheduled</option>
                                    <option value="Played" @if($match->status == 'Played') selected @endif>Played</option>
                                    <option value="Cancelled" @if($match->status == 'Cancelled') selected @endif>Cancelled</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteMatchModal{{ $match->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('matches.destroy', $match->id) }}" class="modal-content">
                        @csrf @method('DELETE')
                        <div class="modal-header"><h5 class="modal-title">Delete Match</h5></div>
                        <div class="modal-body">
                            Are you sure you want to delete this match: <br>
                            <strong>{{ $match->homeClub->name }} vs {{ $match->awayClub->name }}</strong>?
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger">Yes, Delete</button>
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addMatchModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('matches.store') }}" class="modal-content">
            @csrf
            <div class="modal-header"><h5 class="modal-title">Add New Match</h5></div>
            <div class="modal-body">
                <div class="mb-2">
                    <label>Home Club</label>
                    <select name="home_club_id" class="form-control" required>
                        @foreach($clubs as $club)
                            <option value="{{ $club->id }}">{{ $club->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label>Away Club</label>
                    <select name="away_club_id" class="form-control" required>
                        @foreach($clubs as $club)
                            <option value="{{ $club->id }}">{{ $club->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2"><label>Date</label>
                    <input type="date" name="match_date" class="form-control" required>
                </div>
                <div class="mb-2"><label>Venue</label>
                    <input type="text" name="venue" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">Save Match</button>
            </div>
        </form>
    </div>
</div>
@endsection

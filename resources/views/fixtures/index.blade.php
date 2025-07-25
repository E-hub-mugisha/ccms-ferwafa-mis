@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Fixture Management</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Fixture Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addFixtureModal">Add Fixture</button>

    <!-- Fixtures Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Match Week</th>
                <th>Home Club</th>
                <th>Away Club</th>
                <th>Date</th>
                <th>Stadium</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fixtures as $fixture)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fixture->match_week ?? 'N/A' }}</td>
                    <td>{{ $fixture->homeClub->name }}</td>
                    <td>{{ $fixture->awayClub->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($fixture->fixture_date)->format('d M Y, H:i') }}</td>
                    <td>{{ $fixture->stadium }}</td>
                    <td>
                        <!-- View Button -->
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#showFixtureModal{{ $fixture->id }}">View</button>

                        <!-- Edit Button -->
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editFixtureModal{{ $fixture->id }}">Edit</button>

                        <!-- Delete Button -->
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteFixtureModal{{ $fixture->id }}">Delete</button>
                    </td>
                </tr>

                <!-- Show Fixture Modal -->
                <div class="modal fade" id="showFixtureModal{{ $fixture->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Fixture Info</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Match Week:</strong> {{ $fixture->match_week }}</p>
                                <p><strong>Home Club:</strong> {{ $fixture->homeClub->name }}</p>
                                <p><strong>Away Club:</strong> {{ $fixture->awayClub->name }}</p>
                                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($fixture->fixture_date)->format('d M Y, H:i') }}</p>
                                <p><strong>Stadium:</strong> {{ $fixture->stadium }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Fixture Modal -->
                <div class="modal fade" id="editFixtureModal{{ $fixture->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('fixtures.update', $fixture->id) }}" method="POST" class="modal-content">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Fixture</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label>Match Week</label>
                                    <input type="text" name="match_week" value="{{ $fixture->match_week }}" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label>Home Club</label>
                                    <select name="home_club_id" class="form-control">
                                        @foreach($clubs as $club)
                                            <option value="{{ $club->id }}" {{ $fixture->home_club_id == $club->id ? 'selected' : '' }}>{{ $club->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label>Away Club</label>
                                    <select name="away_club_id" class="form-control">
                                        @foreach($clubs as $club)
                                            <option value="{{ $club->id }}" {{ $fixture->away_club_id == $club->id ? 'selected' : '' }}>{{ $club->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label>Date</label>
                                    <input type="datetime-local" name="fixture_date" value="{{ \Carbon\Carbon::parse($fixture->fixture_date)->format('Y-m-d\TH:i') }}" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label>Stadium</label>
                                    <input type="text" name="stadium" value="{{ $fixture->stadium }}" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Delete Fixture Modal -->
                <div class="modal fade" id="deleteFixtureModal{{ $fixture->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('fixtures.destroy', $fixture->id) }}" method="POST" class="modal-content">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Fixture</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this fixture?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Fixture Modal -->
<div class="modal fade" id="addFixtureModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('fixtures.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Fixture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label>Match Week</label>
                    <input type="text" name="match_week" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Home Club</label>
                    <select name="home_club_id" class="form-control">
                        <option value="">-- Select Home Club --</option>
                        @foreach($clubs as $club)
                            <option value="{{ $club->id }}">{{ $club->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label>Away Club</label>
                    <select name="away_club_id" class="form-control">
                        <option value="">-- Select Away Club --</option>
                        @foreach($clubs as $club)
                            <option value="{{ $club->id }}">{{ $club->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label>Date</label>
                    <input type="datetime-local" name="fixture_date" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Stadium</label>
                    <input type="text" name="stadium" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">Add</button>
            </div>
        </form>
    </div>
</div>

@endsection

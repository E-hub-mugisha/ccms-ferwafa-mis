@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <h2 class="mb-4">Player Management</h2>

    <!-- Add Player Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPlayerModal">Add Player</button>

    <!-- Flash message -->
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Players Table -->
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <table class="datatable-init-export nowrap table"
                    data-export-title="Export">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Birth Date</th>
                            <th>Position</th>
                            <th>Nationality</th>
                            <th>Club</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($players as $player)
                        <tr>
                            <td>
                                @if($player->photo)
                                <img src="{{ asset('storage/' . $player->photo) }}" width="50" height="50" class="rounded-circle">
                                @else
                                N/A
                                @endif
                            </td>
                            <td>{{ $player->first_name }} {{ $player->last_name }}</td>
                            <td>{{ $player->birth_date }}</td>
                            <td>{{ $player->position }}</td>
                            <td>{{ $player->nationality }}</td>
                            <td>{{ $player->club->name ?? 'N/A' }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewPlayer{{ $player->id }}">View</button>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPlayer{{ $player->id }}">Edit</button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePlayer{{ $player->id }}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @foreach($players as $player)
        <!-- View Modal -->
        <div class="modal fade" id="viewPlayer{{ $player->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title">Player Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Name:</strong> {{ $player->first_name }} {{ $player->last_name }}</p>
                        <p><strong>Birth Date:</strong> {{ $player->birth_date }}</p>
                        <p><strong>Position:</strong> {{ $player->position }}</p>
                        <p><strong>Nationality:</strong> {{ $player->nationality }}</p>
                        <p><strong>Club:</strong> {{ $player->club->name ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Edit Modal -->
        @foreach($players as $player)
        <div class="modal fade" id="editPlayer{{ $player->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('players.update', $player->id) }}" enctype="multipart/form-data" class="modal-content">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title">Edit Player</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>First Name</label>
                            <input type="text" name="first_name" value="{{ $player->first_name }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Last Name</label>
                            <input type="text" name="last_name" value="{{ $player->last_name }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Birth Date</label>
                            <input type="date" name="birth_date" value="{{ $player->birth_date }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Position</label>
                            <input type="text" name="position" value="{{ $player->position }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Nationality</label>
                            <input type="text" name="nationality" value="{{ $player->nationality }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Club</label>
                            <select name="club_id" class="form-select" required>
                                @foreach($clubs as $club)
                                <option value="{{ $club->id }}" {{ $player->club_id == $club->id ? 'selected' : '' }}>
                                    {{ $club->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Photo</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Update Player</button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
        <!-- Delete Modal -->
        @foreach($players as $player)
        <div class="modal fade" id="deletePlayer{{ $player->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('players.destroy', $player->id) }}" class="modal-content">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Delete Player</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete <strong>{{ $player->first_name }} {{ $player->last_name }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
        <!-- Add Player Modal -->
        <div class="modal fade" id="addPlayerModal" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('players.store') }}" enctype="multipart/form-data" class="modal-content">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Add Player</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Birth Date</label>
                            <input type="date" name="birth_date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Position</label>
                            <input type="text" name="position" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Nationality</label>
                            <input type="text" name="nationality" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Club</label>
                            <select name="club_id" class="form-select" required>
                                @foreach($clubs as $club)
                                <option value="{{ $club->id }}">{{ $club->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Photo</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Player</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Club Management</h2>

    <!-- Button to trigger Add Modal -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addClubModal">Add Club</button>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Clubs Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Stadium</th>
                    <th>City</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clubs as $club)
                <tr>
                    <td>
                        @if($club->logo)
                            <img src="{{ asset('storage/' . $club->logo) }}" width="50" height="50" class="rounded-circle">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $club->name }}</td>
                    <td>{{ $club->stadium }}</td>
                    <td>{{ $club->city }}</td>
                    <td>{{ $club->email }}</td>
                    <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#showModal{{ $club->id }}">View</button>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $club->id }}">Edit</button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $club->id }}">Delete</button>
                    </td>
                </tr>

                <!-- Show Modal -->
                <div class="modal fade" id="showModal{{ $club->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title">Club Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Name:</strong> {{ $club->name }}</p>
                                <p><strong>Stadium:</strong> {{ $club->stadium }}</p>
                                <p><strong>City:</strong> {{ $club->city }}</p>
                                <p><strong>Email:</strong> {{ $club->email }}</p>
                                <p><strong>Description:</strong> {{ $club->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $club->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('clubs.update', $club->id) }}" enctype="multipart/form-data" class="modal-content">
                            @csrf
                            @method('PUT')
                            <div class="modal-header bg-warning">
                                <h5 class="modal-title">Edit Club</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $club->name }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Stadium</label>
                                    <input type="text" name="stadium" value="{{ $club->stadium }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>City</label>
                                    <input type="text" name="city" value="{{ $club->city }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ $club->email }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control">{{ $club->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Logo</label>
                                    <input type="file" name="logo" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $club->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('clubs.destroy', $club->id) }}" class="modal-content">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title">Delete Club</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete <strong>{{ $club->name }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            </div>
                        </form>
                    </div>
                </div>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Club Modal -->
<div class="modal fade" id="addClubModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('clubs.store') }}" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add New Club</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Stadium</label>
                    <input type="text" name="stadium" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>City</label>
                    <input type="text" name="city" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label>Logo</label>
                    <input type="file" name="logo" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add Club</button>
            </div>
        </form>
    </div>
</div>

@endsection

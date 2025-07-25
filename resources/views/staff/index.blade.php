@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Staff Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Button to trigger modal -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addStaffModal">
        + Add Staff
    </button>

    <!-- Staff Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Club</th>
                    <th>Position</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Photo</th>
                    <th>Bio</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staff as $s)
                    <tr>
                        <td>{{ $s->name }}</td>
                        <td>{{ $s->club->name }}</td>
                        <td>{{ $s->position }}</td>
                        <td>{{ $s->email }}</td>
                        <td>{{ $s->phone }}</td>
                        <td>
                            @if($s->photo)
                                <img src="{{ asset('storage/' . $s->photo) }}" width="50" class="rounded">
                            @endif
                        </td>
                        <td>{{ Str::limit($s->bio, 50) }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editStaffModal{{ $s->id }}">Edit</button>

                            <!-- Delete Form -->
                            <form action="{{ route('staff.destroy', $s->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this staff?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editStaffModal{{ $s->id }}" tabindex="-1" aria-labelledby="editStaffModalLabel{{ $s->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form method="POST" action="{{ route('staff.update', $s->id) }}" enctype="multipart/form-data" class="modal-content">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Staff - {{ $s->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body row g-3">
                                    <div class="col-md-6">
                                        <label>Club</label>
                                        <select name="club_id" class="form-control" required>
                                            @foreach($clubs as $club)
                                                <option value="{{ $club->id }}" {{ $s->club_id == $club->id ? 'selected' : '' }}>{{ $club->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Name</label>
                                        <input name="name" value="{{ $s->name }}" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Position</label>
                                        <input name="position" value="{{ $s->position }}" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input name="email" value="{{ $s->email }}" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                        <input name="phone" value="{{ $s->phone }}" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Photo</label>
                                        <input type="file" name="photo" class="form-control">
                                    </div>
                                    <div class="col-12">
                                        <label>Bio</label>
                                        <textarea name="bio" class="form-control">{{ $s->bio }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('staff.store') }}" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label>Club</label>
                        <select name="club_id" class="form-control" required>
                            @foreach($clubs as $club)
                                <option value="{{ $club->id }}">{{ $club->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Name</label>
                        <input name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Position</label>
                        <input name="position" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <input name="email" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Phone</label>
                        <input name="phone" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Photo</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                    <div class="col-12">
                        <label>Bio</label>
                        <textarea name="bio" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Add Staff</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

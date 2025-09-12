@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2>Stadiums Management</h2>
    <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addStadiumModal">Add New Stadium</button>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <table class="datatable-init-export nowrap table"
                    data-export-title="Export">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Capacity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stadiums as $stadium)
                        <tr>
                            <td>{{ $stadium->name }}</td>
                            <td>{{ $stadium->location }}</td>
                            <td>{{ $stadium->capacity }}</td>
                            <td>
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#showStadiumModal{{ $stadium->id }}">View</button>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editStadiumModal{{ $stadium->id }}">Edit</button>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteStadiumModal{{ $stadium->id }}">Delete</button>
                            </td>
                        </tr>

                        <!-- Show Modal -->
                        <div class="modal fade" id="showStadiumModal{{ $stadium->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Stadium Details</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Name:</strong> {{ $stadium->name }}</p>
                                        <p><strong>Location:</strong> {{ $stadium->location }}</p>
                                        <p><strong>Capacity:</strong> {{ $stadium->capacity }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editStadiumModal{{ $stadium->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('stadiums.update', $stadium) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Stadium</h5>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" name="name" class="form-control mb-2" value="{{ $stadium->name }}" required>
                                            <input type="text" name="location" class="form-control mb-2" value="{{ $stadium->location }}" required>
                                            <input type="number" name="capacity" class="form-control" value="{{ $stadium->capacity }}" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Update</button>
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteStadiumModal{{ $stadium->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('stadiums.destroy', $stadium) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirm Delete</h5>
                                        </div>
                                        <div class="modal-body">Are you sure you want to delete <strong>{{ $stadium->name }}</strong>?</div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Add Modal -->
    <div class="modal fade" id="addStadiumModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('stadiums.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Stadium</h5>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="name" class="form-control mb-2" placeholder="Stadium Name" required>
                        <input type="text" name="location" class="form-control mb-2" placeholder="Location" required>
                        <input type="number" name="capacity" class="form-control" placeholder="Capacity" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Stadium</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
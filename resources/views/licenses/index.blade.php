@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Licensing & Compliance</h2>

    <!-- Button trigger modal -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addLicenseModal">Add New License</button>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Club</th>
                <th>Type</th>
                <th>Issued</th>
                <th>Expires</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($licenses as $license)
            <tr>
                <td>{{ $license->club->name ?? 'N/A' }}</td>
                <td>{{ $license->license_type }}</td>
                <td>{{ $license->issue_date }}</td>
                <td>{{ $license->expiry_date }}</td>
                <td>
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewLicenseModal{{ $license->id }}">View</button>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editLicenseModal{{ $license->id }}">Edit</button>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteLicenseModal{{ $license->id }}">Delete</button>
                </td>
            </tr>

            <!-- View Modal -->
            <div class="modal fade" id="viewLicenseModal{{ $license->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header"><h5 class="modal-title">License Details</h5></div>
                        <div class="modal-body">
                            <p><strong>Club:</strong> {{ $license->club->name }}</p>
                            <p><strong>Type:</strong> {{ $license->license_type }}</p>
                            <p><strong>Issued:</strong> {{ $license->issue_date }}</p>
                            <p><strong>Expires:</strong> {{ $license->expiry_date }}</p>
                            <p><strong>Remarks:</strong> {{ $license->remarks }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editLicenseModal{{ $license->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('licenses.update', $license->id) }}" class="modal-content">
                        @csrf @method('PUT')
                        <div class="modal-header"><h5 class="modal-title">Edit License</h5></div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>License Type</label>
                                <input name="license_type" value="{{ $license->license_type }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Issue Date</label>
                                <input type="date" name="issue_date" value="{{ $license->issue_date }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Expiry Date</label>
                                <input type="date" name="expiry_date" value="{{ $license->expiry_date }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Remarks</label>
                                <textarea name="remarks" class="form-control">{{ $license->remarks }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteLicenseModal{{ $license->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('licenses.destroy', $license->id) }}" class="modal-content">
                        @csrf @method('DELETE')
                        <div class="modal-header"><h5 class="modal-title">Confirm Delete</h5></div>
                        <div class="modal-body">
                            Are you sure you want to delete this license for "{{ $license->club->name }}"?
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>

            @endforeach
        </tbody>
    </table>
</div>

<!-- Add License Modal -->
<div class="modal fade" id="addLicenseModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('licenses.store') }}" class="modal-content">
            @csrf
            <div class="modal-header"><h5 class="modal-title">Add New License</h5></div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Club</label>
                    <select name="club_id" class="form-control" required>
                        @foreach(App\Models\Club::all() as $club)
                            <option value="{{ $club->id }}">{{ $club->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>License Type</label>
                    <input name="license_type" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Issue Date</label>
                    <input type="date" name="issue_date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Expiry Date</label>
                    <input type="date" name="expiry_date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Remarks</label>
                    <textarea name="remarks" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary">Add License</button>
            </div>
        </form>
    </div>
</div>
@endsection

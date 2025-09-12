@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Transfers</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">New Transfer</button>
    <a href="{{ route('transfers.pdf') }}" class="btn btn-outline-secondary">Download PDF Report</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Player</th>
                <th>From</th>
                <th>To</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transfers as $transfer)
                <tr>
                    <td>{{ $transfer->player->first_name }} {{ $transfer->player->last_name }}</td>
                    <td>{{ $transfer->fromClub->name }}</td>
                    <td>{{ $transfer->toClub->name }}</td>
                    <td>{{ $transfer->transfer_date }}</td>
                    <td>{{ ucfirst($transfer->status) }}</td>
                    <td>
                        @if($transfer->status == 'pending')
                            <a href="{{ route('transfers.approve', $transfer->id) }}" class="btn btn-success btn-sm">Approve</a>
                            <a href="{{ route('transfers.reject', $transfer->id) }}" class="btn btn-danger btn-sm">Reject</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="createModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="{{ route('player_transfers.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">New Transfer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <select name="player_id" class="form-control mb-2">
            <option value="">Select Player</option>
            @foreach(App\Models\Player::all() as $player)
                <option value="{{ $player->id }}">{{ $player->first_name }} {{ $player->last_name }}</option>
            @endforeach
        </select>
        <select name="from_club_id" class="form-control mb-2">
            <option value="">From Club</option>
            @foreach(App\Models\Club::all() as $club)
                <option value="{{ $club->id }}">{{ $club->name }}</option>
            @endforeach
        </select>
        <select name="to_club_id" class="form-control mb-2">
            <option value="">To Club</option>
            @foreach(App\Models\Club::all() as $club)
                <option value="{{ $club->id }}">{{ $club->name }}</option>
            @endforeach
        </select>
        <input type="date" name="transfer_date" class="form-control mb-2" required>
        <input type="text" name="fee" class="form-control mb-2" placeholder="Transfer Fee (optional)">
        <textarea name="notes" class="form-control mb-2" placeholder="Notes"></textarea>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</div>

@endsection

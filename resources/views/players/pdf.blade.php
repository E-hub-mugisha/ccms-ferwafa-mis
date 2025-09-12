<h3>Transfer Report</h3>
<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Player</th>
            <th>From</th>
            <th>To</th>
            <th>Date</th>
            <th>Status</th>
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
            </tr>
        @endforeach
    </tbody>
</table>

<?php

namespace App\Http\Controllers;

use App\Models\PlayerTransfer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PlayerTransferController extends Controller
{
    public function index()
{
    $transfers = PlayerTransfer::with(['player', 'fromClub', 'toClub'])->latest()->get();
    return view('players.transfers', compact('transfers'));
}

public function store(Request $request)
{
    $request->validate([
        'player_id' => 'required',
        'from_club_id' => 'required',
        'to_club_id' => 'required',
        'transfer_date' => 'required|date',
    ]);

    PlayerTransfer::create($request->all());
    return redirect()->back()->with('success', 'Transfer request submitted.');
}

public function update(Request $request, PlayerTransfer $transfer)
{
    $transfer->update($request->all());
    return redirect()->back()->with('success', 'Transfer updated.');
}

public function destroy(PlayerTransfer $transfer)
{
    $transfer->delete();
    return redirect()->back()->with('success', 'Transfer deleted.');
}

public function approve($id)
{
    $transfer = PlayerTransfer::findOrFail($id);
    $transfer->status = 'approved';
    $transfer->save();
    return redirect()->back()->with('success', 'Transfer approved.');
}

public function reject($id)
{
    $transfer = PlayerTransfer::findOrFail($id);
    $transfer->status = 'rejected';
    $transfer->save();
    return redirect()->back()->with('success', 'Transfer rejected.');
}

public function downloadPdf()
{
    $transfers = PlayerTransfer::with(['player', 'fromClub', 'toClub'])->get();
    $pdf = Pdf::loadView('transfers.pdf', compact('transfers'));
    return $pdf->download('transfer_reports.pdf');
}
}

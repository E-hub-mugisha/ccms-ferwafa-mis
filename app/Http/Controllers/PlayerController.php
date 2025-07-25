<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::with('club')->get();
        $clubs = Club::all();
        return view('players.index', compact('players', 'clubs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'club_id' => 'required|exists:clubs,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'birth_date' => 'required|date',
            'position' => 'required|string',
            'nationality' => 'required|string',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('players', 'public');
        }

        Player::create($validated);
        return back()->with('success', 'Player added.');
    }

    public function update(Request $request, Player $player)
    {
        $validated = $request->validate([
            'club_id' => 'required|exists:clubs,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'birth_date' => 'required|date',
            'position' => 'required|string',
            'nationality' => 'required|string',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($player->photo && Storage::disk('public')->exists($player->photo)) {
                Storage::disk('public')->delete($player->photo);
            }
            $validated['photo'] = $request->file('photo')->store('players', 'public');
        }

        $player->update($validated);
        return back()->with('success', 'Player updated.');
    }

    public function destroy(Player $player)
    {
        if ($player->photo && Storage::disk('public')->exists($player->photo)) {
            Storage::disk('public')->delete($player->photo);
        }
        $player->delete();
        return back()->with('success', 'Player deleted.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Matches;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    public function index()
    {
        $matches = Matches::with(['homeClub', 'awayClub'])->get();
        $clubs = Club::all();
        return view('matches.index', compact('matches', 'clubs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'home_club_id' => 'required|different:away_club_id',
            'away_club_id' => 'required',
            'match_date' => 'required|date',
            'venue' => 'required|string|max:255',
        ]);

        Matches::create($validated);
        return back()->with('success', 'Match scheduled.');
    }

    public function update(Request $request, Matches $match)
    {
        $validated = $request->validate([
            'home_club_id' => 'required|different:away_club_id',
            'away_club_id' => 'required',
            'match_date' => 'required|date',
            'venue' => 'required|string|max:255',
            'home_score' => 'nullable|integer',
            'away_score' => 'nullable|integer',
            'status' => 'required|string',
        ]);

        $match->update($validated);
        return back()->with('success', 'Match updated.');
    }

    public function destroy(Matches $match)
    {
        $match->delete();
        return back()->with('success', 'Match deleted.');
    }
}

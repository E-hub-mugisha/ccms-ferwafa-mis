<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Fixture;
use Illuminate\Http\Request;

class FixtureController extends Controller
{
    public function index()
    {
        $fixtures = Fixture::with(['homeClub', 'awayClub'])->get();
        $clubs = Club::all();
        return view('fixtures.index', compact('fixtures', 'clubs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'home_club_id' => 'required|different:away_club_id',
            'away_club_id' => 'required',
            'fixture_date' => 'required|date',
            'stadium' => 'required',
            'match_week' => 'nullable|string',
        ]);

        Fixture::create($validated);
        return redirect()->back()->with('success', 'Fixture added.');
    }

    public function update(Request $request, Fixture $fixture)
    {
        $validated = $request->validate([
            'home_club_id' => 'required|different:away_club_id',
            'away_club_id' => 'required',
            'fixture_date' => 'required|date',
            'stadium' => 'required',
            'match_week' => 'nullable|string',
        ]);

        $fixture->update($validated);
        return redirect()->back()->with('success', 'Fixture updated.');
    }

    public function destroy(Fixture $fixture)
    {
        $fixture->delete();
        return redirect()->back()->with('success', 'Fixture deleted.');
    }

    public function calendar()
    {
        $fixtures = Fixture::all();
        return view('fixtures.calendar', compact('fixtures'));
    }
}

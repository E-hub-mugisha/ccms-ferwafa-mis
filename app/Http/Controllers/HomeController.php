<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Matches;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $clubs = Club::all();
        $players = Player::latest()->get();

        $recentMatch = Matches::where('match_date', '<=', Carbon::now())     // only past matches
            ->orderBy('match_date', 'desc')               // most recent first
            ->first();

        $nextMatch = Matches::where('match_date', '>=', now())
            ->orderBy('match_date', 'asc')
            ->first();

        return view('home', compact('clubs', 'players', 'recentMatch', 'nextMatch'));
    }
    public function players()
    {
        $players = Player::with('club')->latest()->paginate(12);

        return view('players', compact('players'));
    }
    public function matches()
    {
        $recentMatch = Matches::where('match_date', '<=', Carbon::now())     // only past matches
            ->orderBy('match_date', 'desc')               // most recent first
            ->first();

        $nextMatch = Matches::where('match_date', '>=', now())
            ->orderBy('match_date', 'asc')
            ->first();

        $matches = Matches::where('match_date', '>=', now())
            ->orderBy('match_date', 'asc')
            ->take(8) // limit if needed
            ->get();

        return view('matches', compact('matches', 'nextMatch', 'recentMatch'));
    }

    public function clubsPage()
    {
        $clubs = Club::withCount('players')->latest()->paginate(12);
        return view('clubs', compact('clubs'));
    }
}

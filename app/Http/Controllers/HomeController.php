<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Player;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $clubs = Club::all();
        $players = Player::latest()->get();

        return view('home', compact('clubs','players'));
    }
}

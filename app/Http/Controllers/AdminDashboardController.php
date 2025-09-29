<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
{
    return view('dashboard', [
        'clubsCount' => \App\Models\Club::count(),
        'playersCount' => \App\Models\Player::count(),
        'staffCount' => \App\Models\Staff::count(),
        'transfersCount' => \App\Models\PlayerTransfer::count(),
        'recentActivities' => [
            'New player transfer approved.',
            'APR FC added a new staff member.',
            'Rayon Sports updated club details.',
            'New fixture scheduled for next week.',
        ],
    ]);
}

}

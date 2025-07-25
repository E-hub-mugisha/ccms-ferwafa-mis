<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\License;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function index()
{
    $licenses = License::with('club')->get();
    $clubs = Club::all();
    return view('licenses.index', compact('licenses','clubs'));
}

public function store(Request $request)
{
    $request->validate([
        'club_id' => 'required',
        'license_type' => 'required',
        'issue_date' => 'required|date',
        'expiry_date' => 'required|date|after_or_equal:issue_date',
    ]);

    License::create($request->all());
    return redirect()->back()->with('success', 'License added!');
}

}

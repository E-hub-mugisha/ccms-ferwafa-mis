<?php

namespace App\Http\Controllers;

use App\Models\Stadiums;
use Illuminate\Http\Request;

class StadiumController extends Controller
{
    public function index()
    {
        $stadiums = Stadiums::all();
        return view('stadiums.index', compact('stadiums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer',
        ]);

        Stadiums::create($request->all());
        return redirect()->back()->with('success', 'Stadium added successfully!');
    }

    public function update(Request $request, Stadiums $stadium)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer',
        ]);

        $stadium->update($request->all());
        return redirect()->back()->with('success', 'Stadium updated successfully!');
    }

    public function destroy(Stadiums $stadium)
    {
        $stadium->delete();
        return redirect()->back()->with('success', 'Stadium deleted successfully!');
    }
}

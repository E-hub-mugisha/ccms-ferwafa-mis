<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClubController extends Controller
{
    /**
     * Display all clubs.
     */
    public function index()
    {
        $clubs = Club::all();
        return view('club.index', compact('clubs'));
    }

    /**
     * Store a new club.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'stadium' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'email' => 'required|email|unique:clubs,email',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Club::create($validated);

        return redirect()->route('clubs.index')->with('success', 'Club created successfully.');
    }

    /**
     * Update an existing club.
     */
    public function update(Request $request, Club $club)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'stadium' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'email' => 'required|email|unique:clubs,email,' . $club->id,
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle logo update
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($club->logo && Storage::disk('public')->exists($club->logo)) {
                Storage::disk('public')->delete($club->logo);
            }
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $club->update($validated);

        return redirect()->route('clubs.index')->with('success', 'Club updated successfully.');
    }

    /**
     * Delete a club.
     */
    public function destroy(Club $club)
    {
        // Delete logo file if exists
        if ($club->logo && Storage::disk('public')->exists($club->logo)) {
            Storage::disk('public')->delete($club->logo);
        }

        $club->delete();

        return redirect()->route('clubs.index')->with('success', 'Club deleted successfully.');
    }
}

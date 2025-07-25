<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::with('club')->get();
        $clubs = Club::all();
        return view('staff.index', compact('staff', 'clubs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'club_id' => 'required|exists:clubs,id',
            'name' => 'required',
            'position' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png',
            'bio' => 'nullable',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('staff_photos', 'public');
        }

        Staff::create($validated);
        return back()->with('success', 'Staff added.');
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'club_id' => 'required|exists:clubs,id',
            'name' => 'required',
            'position' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png',
            'bio' => 'nullable',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('staff_photos', 'public');
        }

        $staff->update($validated);
        return back()->with('success', 'Staff updated.');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();
        return back()->with('success', 'Staff deleted.');
    }
}

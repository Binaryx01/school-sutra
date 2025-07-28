<?php

namespace App\Http\Controllers;

use App\Models\SchoolSession;
use Illuminate\Http\Request;

class SchoolSessionController extends Controller
{
    public function index()
    {
        $sessions = SchoolSession::all();
        return view('sessions.index', compact('sessions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:school_sessions,name',
        ]);

        SchoolSession::create([
            'name' => $request->name,
        ]);

        return redirect()->route('sessions.index')->with('success', 'Session created successfully!');
    }

        public function create()
{
    return view('sessions.create');
}



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:school_sessions,name,' . $id,
        ]);

        $session = SchoolSession::findOrFail($id);
        $session->update([
            'name' => $request->name,
        ]);

        return redirect()->route('sessions.index')->with('success', 'Session updated successfully!');
    }

    public function destroy($id)
    {
        $session = SchoolSession::findOrFail($id);
        $session->delete();

        return redirect()->route('sessions.index')->with('success', 'Session deleted successfully!');
    }

    public function activate($id)
    {
        SchoolSession::query()->update(['is_active' => false]);
        SchoolSession::where('id', $id)->update(['is_active' => true]);

        return redirect()->route('sessions.index')->with('success', 'Active session updated!');
    }
}

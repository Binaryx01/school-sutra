<?php

// app/Http/Controllers/TeacherController.php
namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\SchoolSession;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('session')->latest()->get();
        return view('teachers.index', compact('teachers'));
    }

 public function create()
{
    $activeSession = \App\Models\SchoolSession::where('is_active', true)->first();
    return view('teachers.create', compact('activeSession'));
}

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:teachers',
            'joined_date' => 'required|date',
        ]);

        Teacher::create($request->all());

        return redirect()->route('teachers.index')->with('success', 'Teacher added successfully.');
    }

    public function edit($id)
{
    $teacher = Teacher::findOrFail($id);
    return view('teachers.edit', compact('teacher'));
}

    public function update(Request $request, $id)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'gender' => 'required|string|in:Male,Female',
        'email' => 'required|email|unique:teachers,email,' . $id,
        'phone' => 'nullable|string|max:20',
        'qualification' => 'nullable|string|max:255',
        'address' => 'nullable|string',
        'joined_date' => 'required|date',
    ]);

    $teacher = Teacher::findOrFail($id);
    $teacher->update($request->all());

    return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
}





public function destroy($id)
{
    $teacher = Teacher::findOrFail($id);
    $teacher->delete();

    return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
}



}

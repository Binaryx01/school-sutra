<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\SchoolClass; // Use your actual model name
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('SchoolClass')->get(); // Load related Schoolclass
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        $classes = SchoolClass::all(); // Fetch all classes for dropdown
        return view('subjects.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|integer|exists:classes,id', // Integer, must exist in classes table
            'code' => 'nullable|string|max:50',
            'type' => 'nullable|string|in:Theory,Practical',
        ]);

        Subject::create($request->only('name', 'class_id', 'code', 'type'));

        return redirect()->route('subjects.index')->with('success', 'Subject added!');
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $classes = Schoolclass::all(); // Fetch all classes for dropdown
        return view('subjects.edit', compact('subject', 'classes'));
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|integer|exists:classes,id',
            'code' => 'nullable|string|max:50',
            'type' => 'nullable|string|in:Theory,Practical',
        ]);

        $subject->update($request->only('name', 'class_id', 'code', 'type'));

        return redirect()->route('subjects.index')->with('success', 'Subject updated!');
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Subject deleted!');
    }
}
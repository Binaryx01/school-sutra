<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Http\Request;

class ClassModelController extends Controller
{
    /**
     * Display a listing of the classes with their sections.
     */


public function index(Request $request)
{
    $search = $request->input('search');

    $classes = SchoolClass::with([
        'sections' => function ($query) {
            $query->withCount('students');
        }
    ])
    ->withCount('students') // Add this to count all students directly linked to the class
    ->when($search, function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%');
    })
    ->paginate(10); // Pagination remains

    return view('classes.index', compact('classes', 'search'));
}


    /**
     * Show the form for creating a new class.
     */
    public function create()
    {
        return view('classes.create');
    }

    /**
     * Store a newly created class in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:classes,name',
        ]);

        SchoolClass::create([
            'name' => $request->name,
        ]);

        return redirect()->route('classes.index')->with('success', 'Class created successfully!');
    }

    /**
     * Store a new section for a class.
     */
    public function storeSection(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'section_name' => 'required|string|max:255',
        ]);

        Section::create([
            'class_id' => $request->class_id,
            'name' => $request->section_name,
        ]);

        return redirect()->route('classes.index')->with('success', 'Section added successfully!');
    }

    /**
     * Show the form for editing the specified class.
     */
    public function edit(ClassModel $classModel)
    {
        return view('classes.edit', compact('SchoolClass'));
    }

    /**
     * Update the specified class in storage.
     */
    public function update(Request $request, SchoolClass $classModel)
    {
        $request->validate([
            'name' => 'required|string|unique:classes,name,' . $SchoolClass->id,
        ]);

        $SchoolClass->update([
            'name' => $request->name,
        ]);

        return redirect()->route('classes.index')->with('success', 'Class updated successfully!');
    }

    /**
     * Remove the specified class from storage.
     */
    public function destroy(SchoolClass $SchoolClass)
    {
        // Optionally delete sections related to the class first
        $SchoolClass->sections()->delete();

        $SchoolClass->delete();

        return redirect()->route('classes.index')->with('success', 'Class deleted successfully!');
    }
}

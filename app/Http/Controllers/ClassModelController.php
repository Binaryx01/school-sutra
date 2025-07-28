<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Section;
use Illuminate\Http\Request;

class ClassModelController extends Controller
{
    /**
     * Display a listing of the classes with their sections.
     */
    public function index()
    {
        // Eager load sections
        $classes = ClassModel::with('sections')->get();

        return view('classes.index', compact('classes'));
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

        ClassModel::create([
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
        return view('classes.edit', compact('classModel'));
    }

    /**
     * Update the specified class in storage.
     */
    public function update(Request $request, ClassModel $classModel)
    {
        $request->validate([
            'name' => 'required|string|unique:classes,name,' . $classModel->id,
        ]);

        $classModel->update([
            'name' => $request->name,
        ]);

        return redirect()->route('classes.index')->with('success', 'Class updated successfully!');
    }

    /**
     * Remove the specified class from storage.
     */
    public function destroy(ClassModel $classModel)
    {
        // Optionally delete sections related to the class first
        $classModel->sections()->delete();

        $classModel->delete();

        return redirect()->route('classes.index')->with('success', 'Class deleted successfully!');
    }
}

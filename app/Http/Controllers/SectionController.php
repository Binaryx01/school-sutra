<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $classes = SchoolClass::with(['sections' => function ($query) {
        $query->withCount('students');
    }])->get();

    foreach ($classes as $class) {
        // Collect unique student IDs across all sections
        $studentIds = $class->sections->flatMap(function ($section) {
            return $section->students()->pluck('id');
        })->unique();

        $class->students_count = $studentIds->count();
    }

    return view('classes.index', compact('classes'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        //
    }
}

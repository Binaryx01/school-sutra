<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Section;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    // List all students
    public function index()
    {
        $students = Student::with('class', 'section')->get();
        return view('students.index', compact('students'));
    }

    // Show form to create a new student
  public function create()
{
    $classes = SchoolClass::all();
    $sections = Section::all();
    return view('students.create', compact('classes', 'sections'));
}

    // Store new student in database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'date_of_birth'  => 'required|date',
            'gender'         => 'required|in:Male,Female,Other',
            'class_id'       => 'required|exists:classes,id',
            'section_id'     => 'required|exists:sections,id',
            'guardian_name'  => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'address'        => 'required|string|max:1000',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }
}

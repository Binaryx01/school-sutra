<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Services\FeeCalculator;

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
            'gender'         => 'required|in:male,female,other',
            'class_id'       => 'required|exists:classes,id',
            'section_id'     => 'nullable|exists:sections,id',
            'guardian_name'  => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'address'        => 'required|string|max:1000',
            'is_hostel'      => 'nullable|boolean',
            'uses_transport' => 'nullable|boolean',
        ]);

        Student::create([
            ...$validated,
            'is_hostel' => $request->has('is_hostel'),
            'uses_transport' => $request->has('uses_transport'),
        ]);

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    // Show single student with fee info
    public function show(Student $student)
    {
        $year = now()->year;
        $month = now()->month;

        $feeCalculator = new FeeCalculator($student, $year, $month);

        $totalExpected = $feeCalculator->getTotalExpectedFee();
        $totalPaid = $feeCalculator->getTotalPaidAmount();
        $due = $feeCalculator->getDueAmount();

        return view('students.show', compact('student', 'totalExpected', 'totalPaid', 'due'));
    }

    // Show edit form
    public function edit(Student $student)
    {
        $classes = SchoolClass::with('sections')->get();
        return view('students.edit', compact('student', 'classes'));
    }

    // Update student in database
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'date_of_birth'  => 'required|date',
            'gender'         => 'required|in:male,female,other',
            'class_id'       => 'required|exists:classes,id',
            'section_id'     => 'required|exists:sections,id',
            'guardian_name'  => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'address'        => 'required|string|max:1000',
            'is_hostel'      => 'nullable|boolean',
            'uses_transport' => 'nullable|boolean',
        ]);

        $student->update([
            ...$validated,
            'is_hostel' => $request->has('is_hostel'),
            'uses_transport' => $request->has('uses_transport'),
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    // Delete student
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }

    // Get students by class (AJAX)
    public function getByClass($class_id)
    {
        $students = Student::where('class_id', $class_id)->get();
        return response()->json($students);
    }
}

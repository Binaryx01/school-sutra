@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Student List</h2>
    <a href="{{ route('students.create') }}" class="btn btn-success mb-3">+ Add Student</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Class</th>
                <th>Section</th>
                <th>Guardian</th>
                <th>Contact</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
            <tr>
                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                <td>{{ $student->date_of_birth }}</td>
                <td>{{ $student->gender }}</td>
                <td>{{ $student->class->name ?? '—' }}</td>
                <td>{{ $student->section->name ?? '—' }}</td>
                <td>{{ $student->guardian_name }}</td>
                <td>{{ $student->contact_number }}</td>
                <td>{{ $student->address }}</td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">No students found</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

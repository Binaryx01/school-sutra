@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Student Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Name:</strong> {{ $student->first_name }} {{ $student->last_name }}</p>
                    <p><strong>DOB:</strong> 
    @if($student->date_of_birth)
        {{ \Carbon\Carbon::parse($student->date_of_birth)->format('d/m/Y') }}
    @else
        —
    @endif
</p>
                    <p><strong>Gender:</strong> {{ ucfirst($student->gender) }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Class:</strong> {{ $student->class->name ?? '—' }}</p>
                    <p><strong>Section:</strong> {{ $student->section->name ?? '—' }}</p>
                    <p><strong>Guardian:</strong> {{ $student->guardian_name }}</p>
                </div>
            </div>
            <hr>
            <p><strong>Contact:</strong> {{ $student->contact_number }}</p>
            <p><strong>Address:</strong> {{ $student->address }}</p>
        </div>
        <div class="card-footer bg-white">
            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>
@endsection
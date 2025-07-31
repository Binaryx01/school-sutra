@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Student List</h2>
        <a href="{{ route('students.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Add Student
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>DOB</th>
                            <th>Gender</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Guardian</th>
                            <th>Contact</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                        <tr>
                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                            <td>
                                @if($student->date_of_birth)
                                    {{ \Carbon\Carbon::parse($student->date_of_birth)->format('d/m/Y') }}
                                @else
                                    —
                                @endif
                            </td>
                            <td>{{ ucfirst($student->gender) }}</td>
                            <td>{{ $student->class->name ?? '—' }}</td>
                            <td>{{ $student->section->name ?? '—' }}</td>
                            <td>{{ $student->guardian_name }}</td>
                            <td>{{ $student->contact_number }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this student?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-user-graduate fa-2x text-muted mb-3"></i>
                                <p class="text-muted">No students found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Safe pagination check --}}
    @if(method_exists($students, 'links'))
        <div class="mt-3">
            {{ $students->links() }}
        </div>
    @endif
</div>
@endsection
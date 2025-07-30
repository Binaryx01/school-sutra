@extends('layouts.app')

@section('title', 'Subjects')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <h2 class="mb-4">Subjects List</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <a href="{{ route('subjects.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Add Subject
            </a>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subjects as $subject)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->class_id }}</td>
                            <td>{{ $subject->code ?? '-' }}</td>
                            <td>{{ $subject->type ?? '-' }}</td>
                            <td>
                                <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure to delete this subject?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No subjects found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

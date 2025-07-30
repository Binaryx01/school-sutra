@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Header and Add Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">All Teachers</h2>
        <a href="{{ route('teachers.create') }}" class="btn btn-primary">
            + Add Teacher
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Teachers Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Qualification</th>
                    <th scope="col">Joined</th>
                    <th scope="col">Session</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $index => $teacher)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $teacher->first_name }} {{ $teacher->last_name }}</td>
                    <td>{{ $teacher->gender }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ $teacher->phone ?? '-' }}</td>
                    <td>{{ $teacher->qualification ?? '-' }}</td>
                    <td>{{ $teacher->joined_date }}</td>
                    <td>{{ $teacher->session->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this teacher?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">No teachers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

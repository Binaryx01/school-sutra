@extends('layouts.app')

@section('title', 'Classes & Sections')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Class Management</h2>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-4">
        <!-- Add Class Card -->
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Add New Class</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('classes.store') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" placeholder="Class Name" required>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-plus me-1"></i> Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Section Card -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Add New Section</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('classes.storeSection') }}" method="POST">
                        @csrf
                        <div class="row g-2">
                            <div class="col-md-5">
                                <select name="class_id" class="form-select" required>
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="section_name" class="form-control" placeholder="Section Name" required>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-secondary w-100" type="submit">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Classes Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Class List</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th width="25%">Class</th>
                            <th width="45%">Sections</th>
                            <th width="25%">Students</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($classes as $index => $class)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $class->name }}</strong>
                                </td>
                                <td>
                                    @foreach($class->sections as $section)
                                        <span class="badge bg-light text-dark border me-1 mb-1 py-2 px-3">
                                            {{ $section->name }}
                                            <small class="text-muted ms-1">({{ $section->students_count ?? 0 }})</small>
                                        </span>
                                    @endforeach
                                    @if($class->sections->isEmpty())
                                        <span class="text-muted">No sections</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-primary rounded-pill py-2 px-3">
                                        {{ $class->students_count ?? 0 }} students
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <i class="fas fa-school fa-2x text-muted mb-3"></i>
                                    <p class="text-muted">No classes found. Add your first class above.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .badge {
        font-weight: 500;
    }
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    .card-header {
        border-bottom: none;
    }
</style>
@endsection
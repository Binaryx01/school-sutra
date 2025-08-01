@extends('layouts.app')

@section('title', 'Fee Types')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Fee Types</h2>
            <a href="{{ route('fee-types.create') }}" class="btn btn-primary">Add Fee Type</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feeTypes as $feeType)
                            <tr>
                                <td>{{ $feeType->name }}</td>
                                <td>{{ $feeType->description ?? '-' }}</td>
                                <td>{{ $feeType->is_active ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <a href="{{ route('fee-types.edit', $feeType) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('fee-types.destroy', $feeType) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
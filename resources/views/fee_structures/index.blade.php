@extends('layouts.app')

@section('title', 'Fee Structures')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Fee Structures</h2>
            <a href="{{ route('fee-structures.create') }}" class="btn btn-primary">Add Fee Structure</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Class</th>
                            <th>Fee Type</th>
                            <th>Amount</th>
                            <th>Frequency</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feeStructures as $feeStructure)
                            <tr>
                                <td>{{ $feeStructure->class->name }}</td>
                                <td>{{ $feeStructure->feeType->name }}</td>
                                <td>{{ $feeStructure->amount }}</td>
                                <td>{{ $feeStructure->frequency }}</td>
                                <td>
                                    <a href="{{ route('fee-structures.edit', $feeStructure) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('fee-structures.destroy', $feeStructure) }}" method="POST" class="d-inline">
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
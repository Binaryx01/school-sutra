@extends('layouts.app')

@section('title', 'Edit Fee Structure')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="mb-0">Edit Fee Structure</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('fee-structures.update', $feeStructure) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="class_id" class="form-label">Class</label>
                    <select name="class_id" id="class_id" class="form-select" required>
                        <option value="">Select Class</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}" {{ $feeStructure->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                    @error('class_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="fee_type_id" class="form-label">Fee Type</label>
                    <select name="fee_type_id" id="fee_type_id" class="form-select" required>
                        <option value="">Select Fee Type</option>
                        @foreach ($feeTypes as $feeType)
                            <option value="{{ $feeType->id }}" {{ $feeStructure->fee_type_id == $feeType->id ? 'selected' : '' }}>{{ $feeType->name }}</option>
                        @endforeach
                    </select>
                    @error('fee_type_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="session_id" class="form-label">Session</label>
                    <select name="session_id" id="session_id" class="form-select">
                        <option value="">Select Session (Optional)</option>
                        @foreach ($sessions as $session)
                            <option value="{{ $session->id }}" {{ $feeStructure->session_id == $session->id ? 'selected' : '' }}>{{ $session->name }}</option>
                        @endforeach
                    </select>
                    @error('session_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" name="amount" id="amount" value="{{ old('amount', $feeStructure->amount) }}" step="0.01" class="form-control" required>
                    @error('amount')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="frequency" class="form-label">Frequency</label>
                    <select name="frequency" id="frequency" class="form-select" required>
                        <option value="monthly" {{ $feeStructure->frequency == 'monthly' ? 'selected' : '' }}>Monthly</option>
                        <option value="quarterly" {{ $feeStructure->frequency == 'quarterly' ? 'selected' : '' }}>Quarterly</option>
                        <option value="yearly" {{ $feeStructure->frequency == 'yearly' ? 'selected' : '' }}>Yearly</option>
                    </select>
                    @error('frequency')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="due_date" class="form-label">Due Date</label>
                    <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $feeStructure->due_date) }}" class="form-control">
                    @error('due_date')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
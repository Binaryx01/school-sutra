@extends('layouts.app')

@section('title', 'Edit Payment')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="mb-0">Edit Payment</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('payments.update', $payment) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="student_id" class="form-label">Student</label>
                    <select name="student_id" id="student_id" class="form-select" required>
                        <option value="">Select Student</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" {{ $payment->student_id == $student->id ? 'selected' : '' }}>{{ $student->first_name }} {{ $student->last_name }}</option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="fee_structure_id" class="form-label">Fee Structure</label>
                    <select name="fee_structure_id" id="fee_structure_id" class="form-select" required>
                        <option value="">Select Fee Structure</option>
                        @foreach ($feeStructures as $feeStructure)
                            <option value="{{ $feeStructure->id }}" {{ $payment->fee_structure_id == $feeStructure->id ? 'selected' : '' }}>{{ $feeStructure->feeType->name }} - {{ $feeStructure->class->name }} ({{ $feeStructure->amount }})</option>
                        @endforeach
                    </select>
                    @error('fee_structure_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="payment_method_id" class="form-label">Payment Method</label>
                    <select name="payment_method_id" id="payment_method_id" class="form-select" onchange="loadCustomFields()">
                        <option value="">Select Payment Method (Optional)</option>
                        @foreach ($paymentMethods as $paymentMethod)
                            <option value="{{ $paymentMethod->id }}" {{ $payment->payment_method_id == $paymentMethod->id ? 'selected' : '' }} data-custom-fields='{{ json_encode($paymentMethod->custom_fields) }}'>{{ $paymentMethod->name }}</option>
                        @endforeach
                    </select>
                    @error('payment_method_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div id="customFields" class="mb-3">
                    @if ($payment->payment_details)
                        @foreach ($payment->payment_details as $key => $value)
                            <div class="mb-3">
                                <label for="payment_details_{{ $key }}" class="form-label">{{ $key }}</label>
                                <input type="text" name="payment_details[{{ $key }}]" id="payment_details_{{ $key }}" value="{{ $value }}" class="form-control">
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" name="amount" id="amount" value="{{ old('amount', $payment->amount) }}" step="0.01" class="form-control" required>
                    @error('amount')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="payment_date" class="form-label">Payment Date</label>
                    <input type="date" name="payment_date" id="payment_date" value="{{ old('payment_date', $payment->payment_date) }}" class="form-control" required>
                    @error('payment_date')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ $payment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('status')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea name="notes" id="notes" class="form-control">{{ old('notes', $payment->receipt->notes ?? '') }}</textarea>
                    @error('notes')
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

<script>
    function loadCustomFields() {
        const select = document.getElementById('payment_method_id');
        const container = document.getElementById('customFields');
        container.innerHTML = '';
        const selectedOption = select.options[select.selectedIndex];
        const customFields = selectedOption.getAttribute('data-custom-fields');
        if (customFields) {
            const fields = JSON.parse(customFields);
            fields.forEach((field, index) => {
                const div = document.createElement('div');
                div.className = 'mb-3';
                div.innerHTML = `
                    <label for="payment_details_${index}" class="form-label">${field.name}</label>
                    <input type="${field.type}" name="payment_details[${field.name}]" id="payment_details_${index}" class="form-control">
                `;
                container.appendChild(div);
            });
        }
    }
    // Load custom fields on page load
    loadCustomFields();
</script>
@endsection
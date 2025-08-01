@extends('layouts.app')

@section('title', 'Create Payment')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="mb-0">Create Payment</h2>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                    @if (session('remaining_fees'))
                        <p>Remaining Fees: {{ session('remaining_fees') }}</p>
                    @endif
                </div>
            @endif

            <form action="{{ route('payments.store') }}" method="POST">
                @csrf

                <!-- Class Selection -->
                <div class="mb-3">
                    <label for="class_id" class="form-label">Class</label>
                    <select id="class_id" name="class_id" class="form-select" required>
                        <option value="">Select Class</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                    @error('class_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Student Selection -->
                <div class="mb-3">
                    <label for="student_id" class="form-label">Student</label>
                    <select name="student_id" id="student_id" class="form-select" required>
                        <option value="">Select Student</option>
                        {{-- Initially empty, filled by JS --}}
                    </select>
                    @error('student_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Fee Structures -->
                <div class="mb-3">
                    <label class="form-label">Fee Structures</label>
                    <div id="fee_structures_container">
                        @foreach ($feeStructures as $feeStructure)
                            <div class="form-check mb-2">
                                <input type="checkbox" 
                                       name="fee_structures[{{ $feeStructure->id }}][id]" 
                                       value="{{ $feeStructure->id }}" 
                                       class="form-check-input fee-structure-checkbox"
                                       data-amount="{{ $feeStructure->amount }}"
                                       data-is-one-time="{{ $feeStructure->feeType->is_one_time ? 'true' : 'false' }}"
                                       onchange="updateTotalAmount()">
                                <label class="form-check-label">
                                    {{ $feeStructure->feeType->name }} - {{ $feeStructure->class->name }} ({{ $feeStructure->amount }})
                                </label>

                                @if (!$feeStructure->feeType->is_one_time)
                                    <input type="number" 
                                           name="fee_structures[{{ $feeStructure->id }}][months]" 
                                           class="form-control form-control-sm d-inline-block w-auto ms-2 months-input"
                                           placeholder="Months"
                                           min="1"
                                           onchange="updateTotalAmount()"
                                           style="display: none;">
                                @endif
                            </div>
                        @endforeach
                    </div>
                    @error('fee_structures')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Total Amount -->
                <div class="mb-3">
                    <label for="amount" class="form-label">Total Amount</label>
                    <input type="number" name="amount" id="amount" step="0.01" class="form-control" readonly>
                    @error('amount')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Payment Method -->
                <div class="mb-3">
                    <label for="payment_method_id" class="form-label">Payment Method</label>
                    <select name="payment_method_id" id="payment_method_id" class="form-select" onchange="loadCustomFields()">
                        <option value="">Select Payment Method (Optional)</option>
                        @foreach ($paymentMethods as $paymentMethod)
                            <option value="{{ $paymentMethod->id }}" data-custom-fields='@json($paymentMethod->custom_fields)'>
                                {{ $paymentMethod->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('payment_method_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Dynamic Custom Fields -->
                <div id="customFields" class="mb-3"></div>

                <!-- Payment Date -->
                <div class="mb-3">
                    <label for="payment_date" class="form-label">Payment Date</label>
                    <input type="date" name="payment_date" id="payment_date" class="form-control" required>
                    @error('payment_date')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                    @error('status')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Notes -->
                <div class="mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                    @error('notes')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Save Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Load students when class changes
        document.getElementById('class_id').addEventListener('change', function () {
            const classId = this.value;
            const studentSelect = document.getElementById('student_id');
            studentSelect.innerHTML = '<option value="">Loading...</option>';

            if (classId) {
                fetch(`/students/by-class/${classId}`)
                    .then(res => res.json())
                    .then(data => {
                        studentSelect.innerHTML = '<option value="">Select Student</option>';
                        data.forEach(student => {
                            studentSelect.innerHTML += `<option value="${student.id}">${student.first_name} ${student.last_name}</option>`;
                        });
                    })
                    .catch(() => {
                        studentSelect.innerHTML = '<option value="">Failed to load students</option>';
                    });
            } else {
                studentSelect.innerHTML = '<option value="">Select Student</option>';
            }
        });

        // Update fee amount when checkboxes change
        window.updateTotalAmount = function () {
            const checkboxes = document.querySelectorAll('.fee-structure-checkbox');
            let total = 0;

            checkboxes.forEach(checkbox => {
                const amount = parseFloat(checkbox.getAttribute('data-amount')) || 0;
                const isOneTime = checkbox.getAttribute('data-is-one-time') === 'true';
                const monthsInput = checkbox.parentElement.querySelector('.months-input');

                if (checkbox.checked) {
                    if (!isOneTime && monthsInput) {
                        monthsInput.style.display = 'inline-block';
                        const months = parseInt(monthsInput.value) || 1;
                        total += amount * months;
                    } else {
                        total += amount;
                    }
                } else {
                    if (monthsInput) monthsInput.style.display = 'none';
                }
            });

            document.getElementById('amount').value = total.toFixed(2);
        };

        // Load custom fields when payment method is selected
        window.loadCustomFields = function () {
            const select = document.getElementById('payment_method_id');
            const selectedOption = select.options[select.selectedIndex];
            const customFields = selectedOption.getAttribute('data-custom-fields');
            const container = document.getElementById('customFields');

            container.innerHTML = '';

            if (customFields && customFields !== 'null') {
                try {
                    const fields = JSON.parse(customFields);
                    fields.forEach(field => {
                        const div = document.createElement('div');
                        div.className = 'mb-3';
                        div.innerHTML = `
                            <label for="payment_details_${field.name}" class="form-label">${field.name}</label>
                            <input type="${field.type}" name="payment_details[${field.name}]" id="payment_details_${field.name}" class="form-control">
                        `;
                        container.appendChild(div);
                    });
                } catch (e) {
                    console.error('Invalid custom fields');
                }
            }
        };
    });
</script>
@endsection

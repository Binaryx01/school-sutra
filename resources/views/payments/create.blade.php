@extends('layouts.app')

@section('title', 'Create Payment')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white border-0 py-3">
            <h4 class="mb-0 fw-semibold">Record New Payment</h4>
        </div>
        <div class="card-body p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    @if (session('remaining_fees'))
                        <div class="mt-2"><strong>Remaining Fees:</strong> {{ session('remaining_fees') }}</div>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('payments.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <div class="row g-3">
                    <!-- Class Selection -->
                    <div class="col-md-6">
                        <label for="class_id" class="form-label">Class</label>
                        <select id="class_id" name="class_id" class="form-select" required>
                            <option value="" selected disabled>Select Class</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                        @error('class_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Student Selection -->
                    <div class="col-md-6">
                        <label for="student_id" class="form-label">Student</label>
                        <select name="student_id" id="student_id" class="form-select" required disabled>
                            <option value="" selected disabled>Select Class first</option>
                        </select>
                        @error('student_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Fee Structures -->
                    <div class="col-12">
                        <div class="card bg-light border-0 p-3">
                            <h5 class="mb-3 fw-semibold">Select Fees</h5>
                            <div id="fee_structures_container" class="row g-2">
                                @foreach ($feeStructures as $feeStructure)
                                    <div class="col-md-6">
                                        <div class="form-check card p-2 border">
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" 
                                                       name="fee_structures[{{ $feeStructure->id }}][id]" 
                                                       value="{{ $feeStructure->id }}" 
                                                       class="form-check-input fee-structure-checkbox mt-0"
                                                       data-amount="{{ $feeStructure->amount }}"
                                                       data-is-one-time="{{ $feeStructure->feeType->is_one_time ? 'true' : 'false' }}"
                                                       onchange="updateTotalAmount()">
                                                <label class="form-check-label ms-2 flex-grow-1">
                                                    <span class="d-block fw-medium">{{ $feeStructure->feeType->name }}</span>
                                                    <small class="text-muted">{{ $feeStructure->class->name }} - {{ $feeStructure->amount }}</small>
                                                </label>
                                            </div>

                                            @if (!$feeStructure->feeType->is_one_time)
                                                <div class="mt-2 months-container" style="display: none;">
                                                    <label class="small text-muted">Duration (months)</label>
                                                    <input type="number" 
                                                           name="fee_structures[{{ $feeStructure->id }}][months]" 
                                                           class="form-control form-control-sm months-input"
                                                           placeholder="1"
                                                           min="1"
                                                           onchange="updateTotalAmount()">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('fee_structures')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Total Amount -->
                    <div class="col-md-6">
                        <label for="amount" class="form-label">Total Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="amount" id="amount" step="0.01" class="form-control" readonly>
                        </div>
                        @error('amount')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Payment Method -->
                    <div class="col-md-6">
                        <label for="payment_method_id" class="form-label">Payment Method</label>
                        <select name="payment_method_id" id="payment_method_id" class="form-select" onchange="loadCustomFields()">
                            <option value="" selected disabled>Select Payment Method</option>
                            @foreach ($paymentMethods as $paymentMethod)
                                <option value="{{ $paymentMethod->id }}" data-custom-fields='@json($paymentMethod->custom_fields)'>
                                    {{ $paymentMethod->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('payment_method_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Dynamic Custom Fields -->
                    <div id="customFields" class="col-12"></div>

                    <!-- Payment Date -->
                    <div class="col-md-4">
                        <label for="payment_date" class="form-label">Payment Date</label>
                        <input type="date" name="payment_date" id="payment_date" class="form-control" required>
                        @error('payment_date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-md-4">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="pending">Pending</option>
                            <option value="completed" selected>Completed</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div class="col-md-4">
                        <label for="notes" class="form-label">Notes</label>
                        <input type="text" name="notes" id="notes" class="form-control" placeholder="Optional notes">
                        @error('notes')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <i class="bi bi-check-circle me-2"></i> Save Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Load students when class changes
        document.getElementById('class_id').addEventListener('change', function () {
            const classId = this.value;
            const studentSelect = document.getElementById('student_id');
            
            studentSelect.innerHTML = '<option value="" selected disabled>Loading...</option>';
            studentSelect.disabled = true;

            if (classId) {
                fetch(`/students/by-class/${classId}`)
                    .then(res => res.json())
                    .then(data => {
                        studentSelect.innerHTML = '<option value="" selected disabled>Select Student</option>';
                        data.forEach(student => {
                            studentSelect.innerHTML += `<option value="${student.id}">${student.first_name} ${student.last_name}</option>`;
                        });
                        studentSelect.disabled = false;
                    })
                    .catch(() => {
                        studentSelect.innerHTML = '<option value="" selected disabled>Error loading students</option>';
                    });
            } else {
                studentSelect.innerHTML = '<option value="" selected disabled>Select Class first</option>';
                studentSelect.disabled = true;
            }
        });

        // Update fee amount when checkboxes change
        window.updateTotalAmount = function () {
            const checkboxes = document.querySelectorAll('.fee-structure-checkbox:checked');
            let total = 0;

            checkboxes.forEach(checkbox => {
                const amount = parseFloat(checkbox.getAttribute('data-amount')) || 0;
                const isOneTime = checkbox.getAttribute('data-is-one-time') === 'true';
                const monthsContainer = checkbox.closest('.form-check').querySelector('.months-container');
                const monthsInput = monthsContainer ? monthsContainer.querySelector('.months-input') : null;

                if (monthsContainer) monthsContainer.style.display = checkbox.checked ? 'block' : 'none';
                
                if (checkbox.checked) {
                    if (!isOneTime && monthsInput) {
                        const months = parseInt(monthsInput.value) || 1;
                        total += amount * months;
                    } else {
                        total += amount;
                    }
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
                    if (fields.length > 0) {
                        const fieldGroup = document.createElement('div');
                        fieldGroup.className = 'card bg-light border-0 p-3 mt-2';
                        fieldGroup.innerHTML = '<h6 class="fw-semibold mb-3">Payment Details</h6>';
                        
                        fields.forEach(field => {
                            const div = document.createElement('div');
                            div.className = 'mb-3';
                            div.innerHTML = `
                                <label for="payment_details_${field.name}" class="form-label small">${field.name}</label>
                                <input type="${field.type}" name="payment_details[${field.name}]" id="payment_details_${field.name}" class="form-control" placeholder="${field.name}">
                            `;
                            fieldGroup.appendChild(div);
                        });
                        
                        container.appendChild(fieldGroup);
                    }
                } catch (e) {
                    console.error('Invalid custom fields', e);
                }
            }
        };

        // Set default payment date to today
        document.getElementById('payment_date').valueAsDate = new Date();
    });
</script>

<style>
    .form-check.card:hover {
        background-color: #f8f9fa;
    }
    .form-check-input:checked + .form-check-label {
        color: var(--bs-primary);
    }
    .card {
        transition: all 0.2s ease;
    }
</style>
@endsection
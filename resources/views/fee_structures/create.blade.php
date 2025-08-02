@extends('layouts.app')

@section('title', 'Create Fee Structure')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="mb-0">Create Fee Structure</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('fee-structures.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="class_id" class="form-label">Class</label>
                    <select name="class_id" id="class_id" class="form-select" required>
                        <option value="">Select Class</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
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
                            <option value="{{ $feeType->id }}">{{ $feeType->name }}</option>
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
                            <option value="{{ $session->id }}">{{ $session->name }}</option>
                        @endforeach
                    </select>
                    @error('session_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" name="amount" id="amount" step="0.01" class="form-control" required>
                    @error('amount')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="frequency" class="form-label">Frequency</label>
                    <select name="frequency" id="frequency" class="form-select" required>
                        <option value="monthly">Monthly</option>
                        <option value="quarterly">Quarterly</option>
                        <option value="yearly">Yearly</option>
                    </select>
                    @error('frequency')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="due_date_nepali" class="form-label">Due Date (B.S.)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                        <input type="text" 
                               name="due_date_nepali" 
                               id="due_date_nepali" 
                               class="form-control nepali-date" 
                               placeholder="Select Nepali Date"
                               value="{{ old('due_date_nepali') }}"
                               autocomplete="off">
                    </div>
                    <input type="hidden" name="due_date" id="due_date" value="{{ old('due_date') }}">
                    @error('due_date')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Nepali Date Picker JS -->
<script src="https://nepalidatepicker.sajanmaharjan.com.np/v5/nepali.datepicker/js/nepali.datepicker.v5.0.5.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Nepali Date Picker
    $('#due_date_nepali').nepaliDatePicker({
        ndpYear: true,
        ndpMonth: true,
        language: "english",
        dateFormat: "YYYY-MM-DD",
        onChange: function(event) {
            // Convert to AD date when Nepali date changes
            const nepaliDate = event.datePicker.getDate();
            const adDate = convertToAD(nepaliDate);
            $('#due_date').val(adDate);
        }
    });

    // Basic conversion function (replace with proper implementation)
    function convertToAD(bsDate) {
        // This is just a placeholder - implement proper BS to AD conversion
        // You might want to use a library like nepali-date-converter
        const parts = bsDate.split('-');
        const bsYear = parseInt(parts[0]);
        const adYear = bsYear - 57; // Approximate conversion
        return `${adYear}-${parts[1]}-${parts[2]}`;
    }
});
</script>

<style>
.nepali-date-picker {
    z-index: 9999 !important;
}
.input-group-text {
    min-width: 45px;
    justify-content: center;
}
.text-danger.small {
    font-size: 0.875em;
    margin-top: 0.25rem;
}
</style>
@endsection
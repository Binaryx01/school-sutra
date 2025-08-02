@extends('layouts.app')

@section('title', 'Edit Teacher')

@section('content')
<div class="container mt-4">
    <h2 class="h4 mb-4">Edit Teacher</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required
                    value="{{ old('first_name', $teacher->first_name) }}">
                @error('first_name')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required
                    value="{{ old('last_name', $teacher->last_name) }}">
                @error('last_name')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="gender" class="form-label">Gender</label>
                <select id="gender" name="gender" class="form-select" required>
                    <option value="">Select</option>
                    <option value="Male" {{ old('gender', $teacher->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender', $teacher->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('gender')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required
                    value="{{ old('email', $teacher->email) }}">
                @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control"
                    value="{{ old('phone', $teacher->phone) }}">
                @error('phone')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="qualification" class="form-label">Qualification</label>
                <input type="text" id="qualification" name="qualification" class="form-control"
                    value="{{ old('qualification', $teacher->qualification) }}">
                @error('qualification')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="address" class="form-label">Address</label>
                <textarea id="address" name="address" rows="2" class="form-control">{{ old('address', $teacher->address) }}</textarea>
                @error('address')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="joined_date_nepali" class="form-label">Joined Date (B.S.)</label>
                <div class="input-group">
                    <span class="input-group-text bg-primary text-white">
                        <i class="fas fa-calendar-alt"></i>
                    </span>
                    <input type="text" 
                           id="joined_date_nepali" 
                           name="joined_date_nepali" 
                           class="form-control nepali-date" 
                           placeholder="Select Nepali Date"
                           value="{{ old('joined_date_nepali', $teacher->joined_date_nepali) }}" 
                           required
                           autocomplete="off">
                </div>
                <input type="hidden" name="joined_date" id="joined_date" value="{{ old('joined_date', $teacher->joined_date) }}">
                @error('joined_date')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Update Teacher</button>
            <a href="{{ route('teachers.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<!-- Nepali Date Picker JS -->
<script src="https://nepalidatepicker.sajanmaharjan.com.np/v5/nepali.datepicker/js/nepali.datepicker.v5.0.5.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Nepali Date Picker
    $('#joined_date_nepali').nepaliDatePicker({
        ndpYear: true,
        ndpMonth: true,
        language: "english",
        dateFormat: "YYYY-MM-DD",
        onChange: function(event) {
            // Convert to AD date when Nepali date changes
            const nepaliDate = event.datePicker.getDate();
            const adDate = convertToAD(nepaliDate);
            $('#joined_date').val(adDate);
        }
    });

    // If editing and need to convert existing AD date to BS
    @if($teacher->joined_date && empty(old('joined_date_nepali')))
        const adDate = "{{ $teacher->joined_date }}";
        const nepaliDate = convertToBS(adDate);
        $('#joined_date_nepali').val(nepaliDate);
    @endif

    // Basic conversion functions (replace with proper implementation)
    function convertToAD(bsDate) {
        // Implement proper BS to AD conversion
        // This is just a placeholder
        const parts = bsDate.split('-');
        const bsYear = parseInt(parts[0]);
        const adYear = bsYear - 57; // Approximate conversion
        return `${adYear}-${parts[1]}-${parts[2]}`;
    }

    function convertToBS(adDate) {
        // Implement proper AD to BS conversion
        // This is just a placeholder
        const parts = adDate.split('-');
        const adYear = parseInt(parts[0]);
        const bsYear = adYear + 57; // Approximate conversion
        return `${bsYear}-${parts[1]}-${parts[2]}`;
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
@extends('layouts.app')

@section('title', 'Register New Student')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-gradient-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-user-plus me-2"></i>Register New Student
                </h4>
                <a href="{{ route('students.index') }}" class="btn btn-sm btn-light">
                    <i class="fas fa-arrow-left me-1"></i> Back to List
                </a>
            </div>
        </div>

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('students.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <!-- Personal Info Section -->
                <div class="mb-4 p-3 bg-light rounded-3">
                    <h5 class="text-primary mb-4">
                        <i class="fas fa-id-card me-2"></i>Personal Information
                    </h5>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">First Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                                <div class="invalid-feedback">Please provide a first name</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Last Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                                <div class="invalid-feedback">Please provide a last name</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="date_of_birth" class="form-label fw-bold">Date of Birth (B.S.)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                                <input type="text" 
                                       name="date_of_birth" 
                                       id="date_of_birth" 
                                       class="form-control" 
                                       placeholder="Select Nepali Date" 
                                       autocomplete="off"
                                       value="{{ old('date_of_birth') }}" 
                                       required>
                                <div class="invalid-feedback">Please select date of birth</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Gender</label>
                            <div class="btn-group w-100" role="group" aria-label="Gender selection">
                                <input type="radio" class="btn-check" name="gender" id="male" value="male" {{ old('gender', 'male') == 'male' ? 'checked' : '' }} required>
                                <label class="btn btn-outline-primary" for="male"><i class="fas fa-mars me-2"></i>Male</label>

                                <input type="radio" class="btn-check" name="gender" id="female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="female"><i class="fas fa-venus me-2"></i>Female</label>

                                <input type="radio" class="btn-check" name="gender" id="other" value="other" {{ old('gender') == 'other' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="other"><i class="fas fa-genderless me-2"></i>Other</label>
                            </div>
                            <div class="invalid-feedback d-block">@error('gender') {{ $message }} @enderror</div>
                        </div>
                    </div>
                </div>

                <!-- Academic Info Section -->
                <div class="mb-4 p-3 bg-light rounded-3">
                    <h5 class="text-primary mb-4">
                        <i class="fas fa-graduation-cap me-2"></i>Academic Information
                    </h5>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Class</label>
                            <select name="class_id" id="classSelect" class="form-select select2" required>
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please select a class</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Section</label>
                            <select name="section_id" id="sectionSelect" class="form-select select2">
                                <option value="">Select Section</option>
                                @if(old('class_id'))
                                    @foreach(\App\Models\Section::where('class_id', old('class_id'))->get() as $section)
                                        <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                            {{ $section->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="invalid-feedback">Please select a section</div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" id="is_hostel" name="is_hostel" value="1" {{ old('is_hostel') ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="is_hostel">
                                    <i class="fas fa-bed me-1"></i>Is Hostel Student?
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" id="uses_transport" name="uses_transport" value="1" {{ old('uses_transport') ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="uses_transport">
                                    <i class="fas fa-bus me-1"></i>Uses School Transport?
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Info Section -->
                <div class="mb-4 p-3 bg-light rounded-3">
                    <h5 class="text-primary mb-4">
                        <i class="fas fa-address-book me-2"></i>Contact Information
                    </h5>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Guardian Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white"><i class="fas fa-user-shield"></i></span>
                                <input type="text" name="guardian_name" class="form-control" value="{{ old('guardian_name') }}" required>
                                <div class="invalid-feedback">Please provide guardian name</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Contact Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white"><i class="fas fa-phone"></i></span>
                                <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number') }}" required>
                                <div class="invalid-feedback">Please provide contact number</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white"><i class="fas fa-map-marker-alt"></i></span>
                                <textarea name="address" class="form-control" rows="2" required>{{ old('address') }}</textarea>
                                <div class="invalid-feedback">Please provide address</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="reset" class="btn btn-outline-danger">
                        <i class="fas fa-undo me-1"></i> Clear Form
                    </button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> Register Student
                    </button>
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
$(document).ready(function () {
    // Initialize Nepali Date Picker with more options
    $('#date_of_birth').nepaliDatePicker({
        ndpYear: true,
        ndpMonth: true,
        ndpYearCount: 100,
        language: "english",
        dateFormat: "YYYY-MM-DD",
        closeOnDateSelect: true,
        disableDaysAfter: 0, // Disable future dates
        onChange: function() {
            // Validate the selected date if needed
        }
    });

    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap-5',
        width: '100%'
    });

    // Dynamic section loading based on class selection
    $('#classSelect').on('change', function () {
        const classId = $(this).val();
        const sectionSelect = $('#sectionSelect');
        
        sectionSelect.empty().append('<option value="">Select Section</option>');
        
        if (classId) {
            $.ajax({
                url: `/classes/${classId}/sections`,
                method: 'GET',
                success: function(sections) {
                    sections.forEach(section => {
                        sectionSelect.append(new Option(section.name, section.id));
                    });
                    @if(old('section_id'))
                        sectionSelect.val("{{ old('section_id') }}").trigger('change');
                    @endif
                },
                error: function(xhr) {
                    console.error('Error loading sections:', xhr.responseText);
                }
            });
        }
    });

    // Trigger change if class is already selected (form validation fail)
    @if(old('class_id'))
        $('#classSelect').trigger('change');
    @endif

    // Form validation
    (function() {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
});
</script>

<style>
.card-header {
    background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
}
.btn-group .btn {
    flex: 1;
}
.select2-container--bootstrap-5 .select2-selection {
    padding: 0.375rem 0.75rem;
    height: auto;
}
.input-group-text {
    min-width: 45px;
    justify-content: center;
}
.invalid-feedback.d-block {
    display: block;
    color: #dc3545;
    font-size: 0.875em;
}
/* Nepali Date Picker styling */
.nepali-date-picker {
    z-index: 9999 !important;
}
</style>
@endsection
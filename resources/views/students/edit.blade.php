@extends('layouts.app')

@section('title', 'Edit Student Profile')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-gradient-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-user-edit me-2"></i>Edit Student Profile
                </h4>
                <a href="{{ route('students.index') }}" class="btn btn-sm btn-light">
                    <i class="fas fa-arrow-left me-1"></i> Back to List
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <form action="{{ route('students.update', $student->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

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
                                <input type="text" name="first_name" class="form-control" 
                                       value="{{ old('first_name', $student->first_name) }}" required>
                                <div class="invalid-feedback">Please provide first name</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Last Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" name="last_name" class="form-control" 
                                       value="{{ old('last_name', $student->last_name) }}" required>
                                <div class="invalid-feedback">Please provide last name</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Date of Birth (B.S.)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                                <input type="text" 
                                       name="date_of_birth_nepali" 
                                       id="date_of_birth_nepali" 
                                       class="form-control" 
                                       placeholder="Select Nepali Date"
                                       value="{{ old('date_of_birth_nepali', $student->date_of_birth_nepali) }}" 
                                       required>
                                <div class="invalid-feedback">Please select date of birth</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Gender</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="gender" id="male" 
                                       value="male" {{ (old('gender', $student->gender) == 'male' ? 'checked' : '') }} required>
                                <label class="btn btn-outline-primary" for="male">
                                    <i class="fas fa-mars me-2"></i>Male
                                </label>
                                
                                <input type="radio" class="btn-check" name="gender" id="female" 
                                       value="female" {{ (old('gender', $student->gender) == 'female' ? 'checked' : '') }}>
                                <label class="btn btn-outline-primary" for="female">
                                    <i class="fas fa-venus me-2"></i>Female
                                </label>
                                
                                <input type="radio" class="btn-check" name="gender" id="other" 
                                       value="other" {{ (old('gender', $student->gender) == 'other' ? 'checked' : '') }}>
                                <label class="btn btn-outline-primary" for="other">
                                    <i class="fas fa-genderless me-2"></i>Other
                                </label>
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
                                   <option value="{{ $class->id }}" 
    {{ old('class_id', $student->class_id) == $class->id ? 'selected' : '' }}>
    {{ $class->name }}
</option>

                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please select a class</div>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Section</label>
                            <select name="section_id" id="sectionSelect" class="form-select select2">
                                <option value="">No Section</option>
                                @if($student->section_id)
                                    <option value="{{ $student->section_id }}" selected>
                                        {{ $student->section->name }}
                                    </option>
                                @endif
                            </select>
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
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-user-shield"></i>
                                </span>
                                <input type="text" name="guardian_name" class="form-control"
                                       value="{{ old('guardian_name', $student->guardian_name) }}" required>
                                <div class="invalid-feedback">Please provide guardian name</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Contact Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-phone"></i>
                                </span>
                                <input type="text" name="contact_number" class="form-control"
                                       value="{{ old('contact_number', $student->contact_number) }}" required>
                                <div class="invalid-feedback">Please provide contact number</div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label fw-bold">Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                <textarea name="address" class="form-control" rows="2" required>{{ old('address', $student->address) }}</textarea>
                                <div class="invalid-feedback">Please provide address</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hidden field for AD date if needed -->
                <input type="hidden" name="date_of_birth" id="date_of_birth_ad" value="{{ old('date_of_birth', $student->date_of_birth ? $student->date_of_birth->format('Y-m-d') : '') }}">

                <!-- Form Actions -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="reset" class="btn btn-outline-danger">
                        <i class="fas fa-undo me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> Update Profile
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
$(document).ready(function() {
    // Initialize Nepali Date Picker
    $('#date_of_birth_nepali').nepaliDatePicker({
        ndpYear: true,
        ndpMonth: true,
        language: "english",
        dateFormat: "YYYY-MM-DD",
        onChange: function(event) {
            // Convert to AD date when Nepali date changes
            const nepaliDate = event.datePicker.getDate();
            const adDate = convertToAD(nepaliDate); // You need to implement this
            $('#date_of_birth_ad').val(adDate);
        }
    });

    // If you need to pre-populate the Nepali date from existing AD date
    @if($student->date_of_birth && empty(old('date_of_birth_nepali')))
        const adDate = "{{ $student->date_of_birth->format('Y-m-d') }}";
        const nepaliDate = convertToBS(adDate); // You need to implement this
        $('#date_of_birth_nepali').val(nepaliDate);
    @endif

    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap-5',
        width: '100%'
    });

    // Load sections when class changes
    $('#classSelect').change(function() {
        const classId = $(this).val();
        const sectionSelect = $('#sectionSelect');
        
        sectionSelect.empty().append('<option value="">No Section</option>');
        
        if (classId) {
            $.get(`/api/classes/${classId}/sections`, function(sections) {
                sections.forEach(section => {
                    sectionSelect.append(new Option(section.name, section.id));
                });
                
                // Re-select current section if exists
                @if($student->section_id)
                    sectionSelect.val({{ $student->section_id }}).trigger('change');
                @endif
            });
        }
    });

    // Trigger change on page load if class is selected
    @if($student->class_id)
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

    // Date conversion functions (you'll need to implement these)
    function convertToBS(adDate) {
        // Implement AD to BS conversion logic
        // This is just a placeholder - you'll need a proper library or function
        return adDate; // Return in YYYY-MM-DD format
    }

    function convertToAD(bsDate) {
        // Implement BS to AD conversion logic
        // This is just a placeholder - you'll need a proper library or function
        return bsDate; // Return in YYYY-MM-DD format
    }
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
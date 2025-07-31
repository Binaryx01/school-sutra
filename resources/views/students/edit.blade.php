@extends('layouts.app')

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
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Date of Birth</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-calendar-day"></i>
                                </span>
                                <input type="date" name="date_of_birth" class="form-control"
                                       value="{{ old('date_of_birth', $student->date_of_birth->format('Y-m-d')) }}" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Gender</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="gender" id="male" 
                                       value="male" {{ $student->gender == 'male' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="male">
                                    <i class="fas fa-mars me-2"></i>Male
                                </label>
                                
                                <input type="radio" class="btn-check" name="gender" id="female" 
                                       value="female" {{ $student->gender == 'female' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="female">
                                    <i class="fas fa-venus me-2"></i>Female
                                </label>
                                
                                <input type="radio" class="btn-check" name="gender" id="other" 
                                       value="other" {{ $student->gender == 'other' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="other">
                                    <i class="fas fa-genderless me-2"></i>Other
                                </label>
                            </div>
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
                                        {{ $student->class_id == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Section (Optional)</label>
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
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label fw-bold">Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                <textarea name="address" class="form-control" rows="2" required>{{ old('address', $student->address) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

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

<!-- Dynamic Section Dropdown with AJAX -->
<script>
$(document).ready(function() {
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
</style>
@endsection
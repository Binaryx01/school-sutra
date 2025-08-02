@extends('layouts.app')

@section('title', 'Create New Academic Session')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Create New Academic Session</h4>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('sessions.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Session Name *</label>
                            <input type="text" 
                                   id="name"
                                   class="form-control @error('name') is-invalid @enderror" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   placeholder="e.g. 2080-2081" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label">Start Date (B.S.) *</label>
                                <input type="text"
                                       id="start_date"
                                       name="start_date"
                                       class="form-control @error('start_date') is-invalid @enderror"
                                       value="{{ old('start_date') }}"
                                       placeholder="Select start date"
                                       required />
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label">End Date (B.S.) *</label>
                                <input type="text" 
                                       id="end_date"
                                       name="end_date"
                                       class="form-control @error('end_date') is-invalid @enderror" 
                                       value="{{ old('end_date') }}"
                                       placeholder="Select end date"
                                       required />
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   {{ old('is_active') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Set as active session</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('sessions.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Create Session
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <!-- Nepali Datepicker JS -->
    <script src="https://nepalidatepicker.sajanmaharjan.com.np/v5/nepali.datepicker/js/nepali.datepicker.v5.0.5.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('start_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true
            });

            document.getElementById('end_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true
            });
        });
    </script>
@endsection

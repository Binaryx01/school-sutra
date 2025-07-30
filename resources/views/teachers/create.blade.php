{{-- resources/views/teachers/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Add New Teacher</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('teachers.store') }}" method="POST" novalidate>
                @csrf
                <input type="hidden" name="session_id" value="{{ $activeSession->id }}">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" name="first_name" id="first_name" class="form-control" required
                            value="{{ old('first_name') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" name="last_name" id="last_name" class="form-control" required
                            value="{{ old('last_name') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                        <select name="gender" id="gender" class="form-select" required>
                            <option value="" disabled selected>Select gender</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" required
                            value="{{ old('email') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" 
                            value="{{ old('phone') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="qualification" class="form-label">Qualification</label>
                        <input type="text" name="qualification" id="qualification" class="form-control" 
                            value="{{ old('qualification') }}">
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" rows="3" class="form-control">{{ old('address') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="joined_date" class="form-label">Joined Date <span class="text-danger">*</span></label>
                        <input type="date" name="joined_date" id="joined_date" class="form-control" required
                            value="{{ old('joined_date') }}">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success px-4">Save Teacher</button>
                    <a href="{{ route('teachers.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

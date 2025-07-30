@extends('layouts.app')

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
            </div>

            <div class="col-md-6">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required
                    value="{{ old('last_name', $teacher->last_name) }}">
            </div>

            <div class="col-md-6">
                <label for="gender" class="form-label">Gender</label>
                <select id="gender" name="gender" class="form-select" required>
                    <option value="">Select</option>
                    <option value="Male" {{ old('gender', $teacher->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender', $teacher->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required
                    value="{{ old('email', $teacher->email) }}">
            </div>

            <div class="col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control"
                    value="{{ old('phone', $teacher->phone) }}">
            </div>

            <div class="col-md-6">
                <label for="qualification" class="form-label">Qualification</label>
                <input type="text" id="qualification" name="qualification" class="form-control"
                    value="{{ old('qualification', $teacher->qualification) }}">
            </div>

            <div class="col-12">
                <label for="address" class="form-label">Address</label>
                <textarea id="address" name="address" rows="2" class="form-control">{{ old('address', $teacher->address) }}</textarea>
            </div>

            <div class="col-md-6">
                <label for="joined_date" class="form-label">Joined Date</label>
                <input type="date" id="joined_date" name="joined_date" class="form-control" required
                    value="{{ old('joined_date', $teacher->joined_date) }}">
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Update Teacher</button>
            <a href="{{ route('teachers.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </div>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Add Subject')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <h2 class="mb-4">Add New Subject</h2>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('subjects.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Subject Name</label>
                    <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label for="class_id" class="form-label">Class</label>
                    <select class="form-select" name="class_id" id="class_id" required>
                        <option value="">-- Select Class --</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="code" class="form-label">Subject Code (Optional)</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}">
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select" id="type" name="type">
                        <option value="Theory" {{ old('type') == 'Theory' ? 'selected' : '' }}>Theory</option>
                        <option value="Practical" {{ old('type') == 'Practical' ? 'selected' : '' }}>Practical</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Subject</button>
                <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
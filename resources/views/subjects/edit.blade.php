@extends('layouts.app')

@section('title', 'Edit Subject')

@section('content')
<h2 class="mb-4">Edit Subject</h2>

@if($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('subjects.update', $subject->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Subject Name</label>
        <input type="text" class="form-control" id="name" name="name" required value="{{ old('name', $subject->name) }}">
    </div>

    <div class="mb-3">
        <label for="class_id" class="form-label">Class</label>
        <select class="form-select" name="class_id" id="class_id" required>
            <option value="">-- Select Class --</option>
            @foreach($classes as $class)
                <option value="{{ $class->id }}" {{ $subject->class_id == $class->id ? 'selected' : '' }}>
                    {{ $class->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="code" class="form-label">Subject Code</label>
        <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $subject->code) }}">
    </div>

    <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <select class="form-select" name="type" id="type">
            <option value="Theory" {{ $subject->type == 'Theory' ? 'selected' : '' }}>Theory</option>
            <option value="Practical" {{ $subject->type == 'Practical' ? 'selected' : '' }}>Practical</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
    <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection

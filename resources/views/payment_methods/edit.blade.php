@extends('layouts.app')

@section('title', 'Edit Payment Method')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="mb-0">Edit Payment Method</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('payment-methods.update', $paymentMethod) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $paymentMethod->name) }}" class="form-control" required>
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Custom Fields</label>
                    <div id="customFields">
                        @foreach ($paymentMethod->custom_fields ?? [] as $index => $field)
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <input type="text" name="custom_fields[{{ $index }}][name]" value="{{ $field['name'] }}" placeholder="Field Name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <select name="custom_fields[{{ $index }}][type]" class="form-select">
                                        <option value="text" {{ $field['type'] == 'text' ? 'selected' : '' }}>Text</option>
                                        <option value="number" {{ $field['type'] == 'number' ? 'selected' : '' }}>Number</option>
                                    </select>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="add全世界

                    addCustomField()" class="btn btn-link">Add Another Field</button>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ $paymentMethod->is_active ? 'checked' : '' }} class="form-check-input">
                    <label for="is_active" class="form-check-label">Active</label>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let fieldCount = {{ count($paymentMethod->custom_fields ?? []) }};
    function addCustomField() {
        const container = document.getElementById('customFields');
        const div = document.createElement('div');
        div.className = 'row mb-2';
        div.innerHTML = `
            <div class="col-md-6">
                <input type="text" name="custom_fields[${fieldCount}][name]" placeholder="Field Name" class="form-control">
            </div>
            <div class="col-md-6">
                <select name="custom_fields[${fieldCount}][type]" class="form-select">
                    <option value="text">Text</option>
                    <option value="number">Number</option>
                </select>
            </div>
        `;
        container.appendChild(div);
        fieldCount++;
    }
</script>
@endsection
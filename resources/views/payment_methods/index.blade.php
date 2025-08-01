@extends('layouts.app')

@section('title', 'Payment Methods')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Payment Methods</h2>
            <a href="{{ route('payment-methods.create') }}" class="btn btn-primary">Add Payment Method</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Custom Fields</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paymentMethods as $paymentMethod)
                            <tr>
                                <td>{{ $paymentMethod->name }}</td>
<td>
    @if (is_array($paymentMethod->custom_fields))
        {{ implode(', ', array_column($paymentMethod->custom_fields, 'name')) }}
    @else
        -
    @endif
</td>
                                <td>{{ $paymentMethod->is_active ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <a href="{{ route('payment-methods.edit', $paymentMethod) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('payment-methods.destroy', $paymentMethod) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
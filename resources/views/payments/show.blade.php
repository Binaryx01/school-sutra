@extends('layouts.app')

@section('title', 'View Payment')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="mb-0">Payment Details</h2>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>Student:</strong> {{ $payment->student->first_name }} {{ $payment->student->last_name }}
            </div>
            <div class="mb-3">
                <strong>Fee Type:</strong> {{ $payment->feeStructure->feeType->name }}
            </div>
            <div class="mb-3">
                <strong>Class:</strong> {{ $payment->feeStructure->class->name }}
            </div>
            <div class="mb-3">
                <strong>Amount:</strong> {{ $payment->amount }}
            </div>
            <div class="mb-3">
                <strong>Payment Date:</strong> {{ $payment->payment_date }}
            </div>
            <div class="mb-3">
                <strong>Payment Method:</strong> {{ $payment->paymentMethod->name ?? '-' }}
            </div>
            @if ($payment->payment_details)
                <div class="mb-3">
                    <strong>Payment Details:</strong>
                    <ul class="list-group list-group-flush">
                        @foreach ($payment->payment_details as $key => $value)
                            <li class="list-group-item">{{ $key }}: {{ $value }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-3">
                <strong>Status:</strong> {{ $payment->status }}
            </div>
            @if ($payment->receipt)
                <div class="mb-3">
                    <strong>Receipt Number:</strong> {{ $payment->receipt->receipt_number }}
                </div>
                <div class="mb-3">
                    <strong>Issue Date:</strong> {{ $payment->receipt->issue_date }}
                </div>
                <div class="mb-3">
                    <strong>Notes:</strong> {{ $payment->receipt->notes ?? '-' }}
                </div>
                <!-- Add PDF download link if implemented -->
            @endif
            <div class="d-flex justify-content-end">
                <a href="{{ route('payments.index') }}" class="btn btn-primary">Back to Payments</a>
            </div>
        </div>
    </div>
</div>
@endsection
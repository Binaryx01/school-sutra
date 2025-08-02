@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Student Details</h4>
        </div>
        <div class="card-body">
            <!-- Personal Info -->
            <h5 class="mb-3 text-secondary">Personal Information</h5>
            <div class="row mb-4">
                <div class="col-md-4">
                    <strong>Full Name:</strong> {{ $student->first_name }} {{ $student->last_name }}
                </div>
                <div class="col-md-4">
                    <strong>Date of Birth:</strong>
                    <span id="dob-display">
                        @if($student->date_of_birth_nepali)
                            {{ $student->date_of_birth_nepali }} (B.S.)
                        @else
                            {{ $student->date_of_birth->format('Y-m-d') }} (A.D.)
                        @endif
                    </span>
                    <input type="hidden" id="dob-ad" value="{{ $student->date_of_birth->format('Y-m-d') }}">
                </div>
                <div class="col-md-2">
                    <strong>Gender:</strong> {{ ucfirst($student->gender) }}
                </div>
            </div>

            <!-- Academic Info -->
            <h5 class="mb-3 text-secondary">Academic Information</h5>
            <div class="row mb-4">
                <div class="col-md-4">
                    <strong>Class:</strong> {{ $student->class->name ?? 'N/A' }}
                </div>
                <div class="col-md-4">
                    <strong>Section:</strong> {{ $student->section->name ?? 'N/A' }}
                </div>
                <div class="col-md-4">
                    <strong>Hostel:</strong> {{ $student->is_hostel ? 'Yes' : 'No' }}
                </div>
                <div class="col-md-4">
                    <strong>Transport:</strong> {{ $student->uses_transport ? 'Yes' : 'No' }}
                </div>
            </div>

            <!-- Contact Info -->
            <h5 class="mb-3 text-secondary">Contact Information</h5>
            <div class="row mb-4">
                <div class="col-md-6">
                    <strong>Guardian Name:</strong> {{ $student->guardian_name }}
                </div>
                <div class="col-md-4">
                    <strong>Contact Number:</strong> {{ $student->contact_number }}
                </div>
                <div class="col-md-12">
                    <strong>Address:</strong> {{ $student->address }}
                </div>
            </div>

            <!-- Fee Summary -->
            <h5 class="mb-3 text-primary">
                Fee Summary (<span id="current-bs-month">
                    @php
                        $currentMonth = now()->month;
                        $bsMonths = ['', 'Baisakh', 'Jestha', 'Ashad', 'Shrawan', 'Bhadra', 
                                    'Ashoj', 'Kartik', 'Mangsir', 'Poush', 'Magh', 'Falgun', 'Chaitra'];
                        $bsYear = now()->year + 57;
                        echo $bsMonths[$currentMonth].' '.$bsYear;
                    @endphp
                </span>)
            </h5>
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Description</th>
                            <th class="text-end">Amount (NPR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total Expected Fee</td>
                            <td class="text-end">{{ number_format($totalExpected, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Total Paid</td>
                            <td class="text-end text-success">{{ number_format($totalPaid, 2) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Due Amount</strong></td>
                            <td class="text-end text-danger"><strong>{{ number_format($due, 2) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <a href="{{ route('students.index') }}" class="btn btn-secondary mt-3">
                <i class="fas fa-arrow-left me-2"></i> Back to Student List
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bikram-sambat-js@1.0.2/dist/index.umd.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Convert Date of Birth
    const adDob = document.getElementById('dob-ad').value;
    if (adDob) {
        try {
            const [year, month, day] = adDob.split('-');
            const adDate = new Date(year, month-1, day);
            const bsDate = window.BS.toBS(adDate);
            const formattedBsDate = `${bsDate.bsYear}-${String(bsDate.bsMonth).padStart(2,'0')}-${String(bsDate.bsDate).padStart(2,'0')}`;
            document.getElementById('dob-display').innerText = formattedBsDate + ' (B.S.)';
        } catch (error) {
            console.error("DOB conversion failed:", error);
        }
    }

    // Convert current month for fee summary
    try {
        const today = new Date();
        const bsNow = window.BS.toBS(today);
        const bsMonthNames = ["","Baisakh","Jestha","Ashad","Shrawan","Bhadra",
                            "Ashoj","Kartik","Mangsir","Poush","Magh","Falgun","Chaitra"];
        document.getElementById('current-bs-month').innerText = 
            `${bsMonthNames[bsNow.bsMonth]} ${bsNow.bsYear}`;
    } catch (error) {
        console.error("Month conversion failed:", error);
    }
});
</script>
@endsection

@section('styles')
<style>
    .table {
        font-size: 0.9rem;
    }
    .table th {
        font-weight: 600;
    }
    #dob-display {
        font-weight: 500;
    }
</style>
@endsection
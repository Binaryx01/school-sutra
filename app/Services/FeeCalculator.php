<?php

namespace App\Services;

use App\Models\FeeType;
use App\Models\FeeStructure;
use App\Models\Payment;
use App\Models\Student;

class FeeCalculator
{
    protected $student;
    protected $year;
    protected $month;

    public function __construct(Student $student, int $year, int $month)
    {
        $this->student = $student;
        $this->year = $year;
        $this->month = $month;
    }

    public function getMonthlyFeeAmount(): float
    {
        $monthlyFeeType = FeeType::where('name', 'monthly')->first();
        if (!$monthlyFeeType) return 0;

        $feeStructure = FeeStructure::where('class_id', $this->student->class_id)
            ->where('fee_type_id', $monthlyFeeType->id)
            ->first();

        return $feeStructure ? $feeStructure->amount : 0;
    }

    public function getHostelFeeAmount(): float
    {
        if (!$this->student->is_hostel) return 0;

        $hostelFeeType = FeeType::where('name', 'hostel')->first();
        if (!$hostelFeeType) return 0;

        $feeStructure = FeeStructure::where('class_id', $this->student->class_id)
            ->where('fee_type_id', $hostelFeeType->id)
            ->first();

        return $feeStructure ? $feeStructure->amount : 0;
    }

    // Add similar methods for transport, lab, computer fees...

    public function getTotalExpectedFee(): float
    {
        return
            $this->getMonthlyFeeAmount() +
            $this->getHostelFeeAmount();
            // + other fee amounts...
    }

    public function getTotalPaidAmount(): float
    {
        $payments = $this->student->payments()
            ->whereYear('payment_date', $this->year)
            ->whereMonth('payment_date', $this->month)
            ->get();

        return $payments->sum('amount');
    }

    public function getDueAmount(): float
    {
        return $this->getTotalExpectedFee() - $this->getTotalPaidAmount();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\FeeStructure;
use App\Models\PaymentMethod;
use App\Models\Payment;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['student', 'paymentMethod'])->latest()->paginate(10);
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $classes = SchoolClass::all();
        $students = Student::with('class')->get();
        $feeStructures = FeeStructure::with(['feeType', 'class'])->get();
        $paymentMethods = PaymentMethod::where('is_active', true)->get();

        return view('payments.create', compact('classes', 'students', 'feeStructures', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'fee_structures' => 'required|array',
            'fee_structures.*.id' => 'required|exists:fee_structures,id',
            'fee_structures.*.months' => 'nullable|integer|min:1',
            'payment_method_id' => 'nullable|exists:payment_methods,id',
            'payment_details' => 'nullable|array',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'status' => 'required|in:pending,completed',
            'notes' => 'nullable|string',
        ]);

        $student = Student::findOrFail($validated['student_id']);
        $totalPaid = 0;

        foreach ($validated['fee_structures'] as $feeStructureData) {
            $feeStructure = FeeStructure::findOrFail($feeStructureData['id']);
            $months = $feeStructure->feeType->is_one_time ? null : ($feeStructureData['months'] ?? 1);
            $amount = $feeStructure->feeType->is_one_time ? $feeStructure->amount : $feeStructure->amount * $months;

            // Prepare payment data array safely
            $paymentData = [
                'student_id' => $validated['student_id'],
                'fee_structure_id' => $feeStructure->id,
                'payment_method_id' => $validated['payment_method_id'] ?? null,
                'amount' => $amount,
                'payment_date' => $validated['payment_date'],
                'status' => $validated['status'],
                'notes' => $validated['notes'] ?? null,
                'months_paid' => $months,
            ];

            if (!empty($validated['payment_details'])) {
                $paymentData['payment_details'] = $validated['payment_details'];
            }

            Payment::create($paymentData);

            $totalPaid += $amount;
        }

        // Calculate total fees for the student's class assuming 12 months for recurring
        $totalFees = FeeStructure::where('class_id', $student->class_id)
            ->whereHas('feeType', function ($query) {
                $query->where('is_active', true);
            })
            ->sum('amount') * 12;

        // Sum total completed payments for this student
        $totalPaidSoFar = Payment::where('student_id', $student->id)
            ->where('status', 'completed')
            ->sum('amount');

        $remainingFees = $totalFees - $totalPaidSoFar;

        return redirect()->route('payments.index')
            ->with('success', 'Payment(s) created successfully.')
            ->with('remaining_fees', number_format($remainingFees, 2));
    }
}

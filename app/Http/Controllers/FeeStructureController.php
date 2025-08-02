<?php

namespace App\Http\Controllers;

use App\Models\FeeType;
use App\Models\ClassModel;
use App\Models\SchoolSession;
use App\Models\FeeStructure;
use Illuminate\Http\Request;
use App\Models\SchoolClass;

class FeeStructureController extends Controller
{
    public function index()
    {
        $feeStructures = FeeStructure::with(['class', 'feeType', 'session'])->get();
        return view('fee_structures.index', compact('feeStructures'));
    }

    public function create()
    {
        $classes = SchoolCLass::all();
        $feeTypes = FeeType::where('is_active', true)->get();
        $sessions = SchoolSession::all();
        return view('fee_structures.create', compact('classes', 'feeTypes', 'sessions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'fee_type_id' => 'required|exists:fee_types,id',
            'session_id' => 'nullable|exists:school_sessions,id',
            'amount' => 'required|numeric|min:0',
            'frequency' => 'required|string',
            'due_date' => 'nullable|date',
        ]);

        FeeStructure::create($request->all());
        return redirect()->route('fee-structures.index')->with('success', 'Fee Structure created successfully.');
    }

    public function edit(FeeStructure $feeStructure)
    {
        $classes = SchoolClass::all();
        $feeTypes = FeeType::where('is_active', true)->get();
        $sessions = SchoolSession::all();
        return view('fee_structures.edit', compact('feeStructure', 'classes', 'feeTypes', 'sessions'));
    }

    public function update(Request $request, FeeStructure $feeStructure)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'fee_type_id' => 'required|exists:fee_types,id',
            'session_id' => 'nullable|exists:academic_sessions,id',
            'amount' => 'required|numeric|min:0',
            'frequency' => 'required|string',
            'due_date' => 'nullable|date',
        ]);

        $feeStructure->update($request->all());
        return redirect()->route('fee-structures.index')->with('success', 'Fee Structure updated successfully.');
    }

    public function destroy(FeeStructure $feeStructure)
    {
        $feeStructure->delete();
        return redirect()->route('fee-structures.index')->with('success', 'Fee Structure deleted successfully.');
    }
}
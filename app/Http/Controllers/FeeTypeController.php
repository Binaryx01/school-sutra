<?php

namespace App\Http\Controllers;

use App\Models\FeeType;
use Illuminate\Http\Request;

class FeeTypeController extends Controller
{
    public function index()
    {
        $feeTypes = FeeType::all();
        return view('fee_types.index', compact('feeTypes'));
    }

    public function create()
    {
        return view('fee_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:fee_types',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        FeeType::create($request->all());
        return redirect()->route('fee-types.index')->with('success', 'Fee Type created successfully.');
    }

    public function edit(FeeType $feeType)
    {
        return view('fee_types.edit', compact('feeType'));
    }

    public function update(Request $request, FeeType $feeType)
    {
        $request->validate([
            'name' => 'required|string|unique:fee_types,name,' . $feeType->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $feeType->update($request->all());
        return redirect()->route('fee-types.index')->with('success', 'Fee Type updated successfully.');
    }

    public function destroy(FeeType $feeType)
    {
        $feeType->delete();
        return redirect()->route('fee-types.index')->with('success', 'Fee Type deleted successfully.');
    }
}
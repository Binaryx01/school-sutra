<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::all();
        return view('payment_methods.index', compact('paymentMethods'));
    }

    public function create()
    {
        return view('payment_methods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:payment_methods',
            'custom_fields' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        PaymentMethod::create([
            'name' => $request->name,
            'custom_fields' => $request->custom_fields ? json_encode($request->custom_fields) : null,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('payment-methods.index')->with('success', 'Payment Method created successfully.');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('payment_methods.edit', compact('paymentMethod'));
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $request->validate([
            'name' => 'required|string|unique:payment_methods,name,' . $paymentMethod->id,
            'custom_fields' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        $paymentMethod->update([
            'name' => $request->name,
            'custom_fields' => $request->custom_fields ? json_encode($request->custom_fields) : null,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('payment-methods.index')->with('success', 'Payment Method updated successfully.');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();
        return redirect()->route('payment-methods.index')->with('success', 'Payment Method deleted successfully.');
    }
}
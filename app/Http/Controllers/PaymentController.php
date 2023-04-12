<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Loan;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Loan $loan)
    {
        $payments = Payment::where('loan_id', $loan->id)->get();
        return view('payments.index', compact('payments', 'loan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        ;
    }

    public function store(Loan $loans)
    {


    }


    public function show(Payment $payment)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}

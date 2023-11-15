<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Loan;
use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function store(PaymentRequest $request)
    {
        $loan_id = $request->input('loan_id');

        $payment = new Payment();
        $payment->amount = $request->input('amount');
        $payment->loan_id = $loan_id;
        $payment->month = $request->input('month');
        $payment->payment_date = $request->input('payment_date');
        $payment->save();

        $loan = Loan::where('id', $loan_id)->first();

        $loan->total_paid = $loan->total_paid + $payment->amount;
        $loan->debt = $loan->amount - $loan->total_paid;
        $loan->save();

        return redirect()->route('loans.show', $loan);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Loan $loan)
    {
        return view('payments.create', compact('loan'));
    }
    public function index(){

    }




    public function show(Payment $payment)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $status = [1=>'Pago', 2=>'Divida'];
        return view('payments.edit', compact('status', 'payment'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $status = $request->input('status');
        $loan = Loan::where('id', $payment->loan_id )->first();

        if($status == 1){
            $payment->status = 'Pago';
            $payment->save();
            $loan->total_paid = $loan->total_paid + $payment->amount;
            $loan->save();

            flash('pagamento editado')->success();
            return redirect()->route('loans.show', $loan);
        }
        if($status == 2){
            $payment->status = 'Divida';
            $payment->save();

            flash('pagamento editado')->success();
            return redirect()->route('loans.show', $loan);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}

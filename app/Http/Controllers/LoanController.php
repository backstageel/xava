<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Person;
use App\Models\Loan;
use App\Models\Payment;
use Illuminate\Http\Request;


class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $loans = Loan::with(['employee'])->paginate(20);
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('loans.form');
    }





    //metodo para simulacao do emprestimo
    public function store(LoanRequest $request)
    {
        $user = $request->user();
        $person = Person::where('user_id', $user->id)->first();
        $employee = Employee::where('person_id', $person->user_id)->first();

            $loan = new Loan();
            $loan->amount = $request->input(['amount']);
            $loan->months = 24; //constante
            $loan->employee_id = $employee->id;

            if($loan->amount < 0){
                flash('Valor introduzido menor que zero')->error();
                return redirect()->route('loans.create');
            } else {
                $loan->installment = $loan->amount / $loan->months;
                if (($employee->base_salary / 3) < $loan->installment) {
                    flash('Emprestimo impossivel, prestacao maior que 1/3 do seu salario.
                    Por favor, tente um valor mais baixo'
                    )->error();
                    return redirect()->route('loans.create');
                } else {
                    $loan->save();
                    flash('Emprestimo válido')->success();
                    return view('loans.submit', compact('loan', 'employee'));
                }
            }

    }


    public function show(Loan $loan)
    {
        $employee = Employee::where('id', $loan->employee_id)->first();
        return view('loans.show', compact('employee', 'loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        $order_status = [1 => 'Pedido Recusado', 2 => 'Pedido Aceite'];
        return view('loans.edit', compact('order_status', 'loan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LoanRequest $request, Loan $loan)
    {
        $loan->order_status = $request->input('order_status');
        $loan->save();

        if($loan->order_status == 2){

            for($i=1; $i<=$loan->months; $i++) {
                $payment = new Payment();
                $payment->loan_id = $loan->id;
                $payment->months = now()->addMonths($i);
                $payment->status = 'Pendente';
                $payment->payment_date = null;


            }
            flash('pagamentos gerados')->success();
            return redirect()->route('loans.index');
        } else {
            #notificar email do usuario que foi recusado o emprestimo
            return redirect()->route('loans.index');
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

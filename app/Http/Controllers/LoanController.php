<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
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
        $user = auth()->user();
        $person = Person::where('user_id', $user->id)->first();
        $employee = Employee::where('person_id', $person->user_id)->first();
        if (isset($employee)) {
            $loan = new Loan();
            $loan->amount = $request->input(['amount']);
            $loan->months = $request->input('months');
            $loan->installment = $request->input('installment');
            $loan->employee_id = $employee->id;

            if (is_null($loan->installment) && is_null($loan->months)) {
                $loan->months = 24;
                $loan->installment = $loan->amount / $loan->months;
                if (($employee->base_salary / 3) < $loan->installment) {
                    flash(
                        'Valor Alto, impossivel pagar em 24meses pois a prestacao excede a 3
                    perte do salario'
                    )->success();
                    return redirect()->route('loans.create');
                } else {
                    $loan->save();
                    flash('Emprestimo valido para pagar em 24 meses')->success();
                    return view('loans.submit', compact('loan', 'employee'));
                }
            } else {
                if (is_null($loan->months)) {
                    $loan->months = ceil($loan->amount / $loan->installment);
                    if ((($employee->base_salary / 3) < $loan->installment) || $loan->months > 24) {
                        flash('Emprestimo invalido')->success();
                        return redirect()->route('loans.create');
                    } else {
                        $loan->save();
                        flash('Emprestimo valido')->success();
                        return view('loans.submit', compact('loan', 'employee'));
                    }
                } else {
                    if (is_null($loan->installment)) {
                        $loan->installment = $loan->amount / $loan->months;
                        if ((($employee->base_salary / 3) < $loan->installment) || $loan->months > 24) {
                            flash('Emprestimo Invalido')->success();
                            return redirect()->route('loans.create');
                        } else {
                            $loan->save();
                            flash('Emprestimo valido')->success();
                            return view('loans.submit', compact('loan', 'employee'));
                        }
                    } else {
                        if ((($employee->base_salary / 3) < $loan->installment) || $loan->months > 24) {
                            flash('Emprestimo invalido')->success();
                            return redirect()->route('loans.create');
                        } else {
                            if ($loan->amount == $loan->installment * $loan->months) {
                                $loan->save();
                                flash('Emprestimo valido ')->success();
                                return view('loans.submit', compact('loan', 'employee'));
                            } else {
                                flash('Emprestimo invalido')->success();
                                return redirect()->route('loans.create');
                            }
                        }
                    }
                }
            }
        } else {
            flash('Codigo de funcionario invalido ')->success();
            return redirect()->route('loans.create');
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
            $auxiliar = $loan->amount;
            for($i=1; $i<=$loan->months; $i++) {
                $payment = new Payment();
                $payment->loan_id = $loan->id;
                $payment->months = now()->addMonths($i);
                $payment->status = 'Pendente';
                $payment->payment_date = null;

                if ($auxiliar >= $loan->installment) {
                    $payment->amount = $loan->installment;
                    $payment->save();
                }else{
                    $payment->amount = $auxiliar;
                    $payment->save();
            }
                $auxiliar= $auxiliar - $loan->installment;
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

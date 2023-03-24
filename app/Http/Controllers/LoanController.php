<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
use App\Models\Employee;
use App\Models\Loan;
use Illuminate\Http\Request;


class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $loans = Loan::paginate(20);
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
        $employee = Employee::where('employee_code', $request->input(['employee_code']))->first();
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
                    $loan->months = $loan->amount / $loan->installment;
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
        $employee = Employee::where('employee_code', $loan->employee_id);
        return view('loans.show', compact('employee', 'loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order_status = [1 => 'Pedido Recusado', 2 => 'Pedido Aceite'];
        return view(
            'loans.edit',
            compact('order_status')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        $loan->order_status = $request->input('order_status');
        $loan->save();

        if($loan = 'Pedido Aceite'){
            #gerar todos pagamentos
        } else {
            #notificar email do usuario que foi recusado o emprestimo
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

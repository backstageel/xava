<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Loan;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Requests\LoanRequest;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loan::with(['loan'])->paginate(20);
        return view('loans.index',compact('loans'));
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
            $amount = $request->input(['amount']);
            $employee = Employee::where('employee_code',$request->input(['employee_code']))->first();
            $installment = $request->input('installment');
            $months=$request->input('months');


            if(is_null( $installment) && is_null($months)) {
                $months = 24;
                $installment = $amount / $months;
                if (($employee->base_salary / 3) < $installment) {
                    flash('Valor Alto, impossivel pagar em 24meses pois a prestacao excede a 3
                    perte do salario')->success();
                    return redirect()->route('loans.create');
                } else {
                    flash('Emprestimo valido para pagar em 24 meses')->success();
                    return view('loans.submit', compact('amount', 'installment',
                    'months', 'employee'));
                }
            } else if(is_null($months)) {
                $months = $amount / $installment;
                if ((($employee->base_salary / 3) < $installment) || $months > 24) {
                    flash('Emprestimo invalido')->success();
                    return redirect()->route('loans.create');
                } else {
                    flash('Emprestimo valido ')->success();
                    return view('loans.submit', ccompact('amount', 'installment',
                        'months', 'employee'));
                }
            } else if (is_null($installment)){
                $installment = $amount/ $months;
                if ((($employee->base_salary / 3) < $installment) || $months > 24) {
                    flash('Emprestimo invalido')->success();
                    return redirect()->route('loans.create');
                } else {
                    flash('Emprestimo valido ')->success();
                    return view('loans.submit', compact('amount', 'installment',
                        'months', 'employee'));
                }
            }

    }



    public function show(Loan $loan)
    {
        $employee = Employee::where('employee_code',$loan->employee_id);

        return view('loans.show',compact('employee', 'loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

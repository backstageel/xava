<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Employee;
use App\Models\Person;
use App\Models\Loan;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;


class LoanController extends Controller
{
    private $user_id, $person_id;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loan::with('employee', 'user')->paginate(500);
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
    public function simulate(LoanRequest $request)
    {
        $this->user_id = Auth::user()->id;
        $this->person_id = Person::where('user_id', $this->user_id)->value('id');
        $employee_id = Employee::where('person_id', $this->person_id)->value('id');
        $employee = Employee::where('id', $employee_id)->first();

        Carbon::setLocale('pt_BR');
        $year = Carbon::now()->year;
        $lastTwoDigits = substr($year, -2);
        $last_Id = Loan::count();

        $loan = new Loan();
        $loan->internal_reference = ('LN'.$lastTwoDigits.($last_Id<10?'0':'').(1+$last_Id));
        $loan->amount = $request->input(['amount']);
        $loan->months = 24; //constante
        $loan->employee_id = $employee_id;
        $loan->status = 'Simulacao';

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
                    return view('loans.submit', compact('loan'));
                }
            }

    }

    public function submit(Loan $loan)
    {
        $loan->status = 'Pendente';
        $loan->save();
        flash('Emprestimo Submetido')->success();
        return redirect()->route('loan.myLoans');

    }

    public function myLoans(){
        $this->user_id = Auth::user()->id;
        $this->person_id = Person::where('user_id', $this->user_id)->value('id');
        $employee_id = Employee::where('person_id', $this->person_id)->value('id');
        $loans = Loan::with('employee', 'user')->where('employee_id', $employee_id)->get();
        return view('loans.myLoans', compact('loans'));
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
    public function approve(Loan $loan)
    {
        $loan->status = 'Aprovado';
        $loan->responsible_id = Auth::user()->id;
        $loan->response_date = Date::now();
        $loan->debt = $loan->amount - $loan->total_paid;
        $loan->save();
        flash('Emprestimo Aprovado')->success();
        return redirect()->route('loans.index');
    }

    public function reject(Loan $loan)
    {
        $loan->status = 'Rejeitado';
        $loan->responsible_id = Auth::user()->id;
        $loan->response_date = Date::now();
        $loan->save();
        flash('Emprestimo Rejeitado')->success();
        return redirect()->route('loans.index');
    }
    public function cancel(Loan $loan)
    {
        $this->user_id = Auth::user()->id;
        $this->person_id = Person::where('user_id', $this->user_id)->value('id');
        $employee_id = Employee::where('person_id', $this->person_id)->value('id');

        if ($employee_id == $loan->employee_id) {
            $loan->status = 'Cancelado';
            $loan->save();
            flash('Emprestimo Cancelado')->success();
            return redirect()->route('loan.myLoans');
        } else {
            $loan->status = 'Cancelado';
            $loan->save();
            flash('Emprestimo Cancelado')->success();
            return redirect()->route('loans.index');
        }

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
                $payment->months = now()->addMonths($i)->format('m');
                $payment->status = 'Pendente';
                $payment->amount = $loan->installment;
                $payment->payment_date = null;
                $payment->save();


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
    public function destroy(Loan $loan)
    {
        $loan->delete();
        flash('Simulação removida com sucesso')->success();
        return redirect()->route('loan.myLoans');

    }
}

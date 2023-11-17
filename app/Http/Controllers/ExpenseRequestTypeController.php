<?php

namespace App\Http\Controllers;

use App\Models\ExpenseRequestType;
use Illuminate\Http\Request;
//use Illuminate\Http\Requests\ExpenseRequestTypeRequest;
use App\Http\Requests\ExpenseRequestTypeRequest;

class ExpenseRequestTypeController extends Controller
{
    public function index()
    {
        $expense_request_types = ExpenseRequestType::get();
        return view('expense_request_types.index', compact('expense_request_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expense_request_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseRequestTypeRequest $request)
    {
        $expense_request_type = new ExpenseRequestType();

        if (($request->input('name')) != null) {
            $expense_request_type->name = $request->input('name');
        }else{
            flash('Campo nome não pode ser nulo')->error();
            return redirect()->back()->withInput();
        }

        $expense_request_type->save();
        flash('Tipo de Despesa Registado com sucesso')->success();
        return redirect()->route('expense_request_types.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpenseRequestType $expense_request_type)
    {

        return view('expense_request_types.edit', compact('expense_request_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequestTypeRequest $request, ExpenseRequestType $expense_request_type)
    {
        if (($request->input('name')) != null) {
            $expense_request_type->name = $request->input('name');
        }else{
            flash('Campo nome não pode ser nulo')->error();
            return redirect()->back()->withInput();
        }

        $expense_request_type->save();
        flash('Tipo de Despesa Actualizado com sucesso')->success();
        return redirect()->route('expense_request_types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

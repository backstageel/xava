<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeTypeRequest;
use App\Models\EmployeeType;
use Illuminate\Http\Request;

class EmployeeTypessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeeTypes = EmployeeType::paginate();
        return view('employee_types.index',compact('employeeTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeTypeRequest $request)
    {
        $employeeType = new EmployeeType();
        $employeeType->name = $request->input('name');
        $employeeType->save();
        flash('Tipo de Colaborador Registado com sucesso')->success();
        return redirect()->route('employee_types.index');
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

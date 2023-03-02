<?php

namespace App\Http\Controllers;

use App\Actions\CreateEmployeeAction;
use App\DataTables\EmployeesDataTable;
use App\Http\Requests\CreateEmployeeRequest;
use App\Models\CivilState;
use App\Models\ContractType;
use App\Models\Country;
use App\Models\Department;
use App\Models\District;
use App\Models\Employee;
use App\Models\EmployeePosition;
use App\Models\EmployeeType;
use App\Models\Gender;
use App\Models\IdentityDocumentType;
use App\Models\PersonPrefix;
use App\Models\Province;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EmployeesDataTable $dataTable)
    {
        return $dataTable->render('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genders = Gender::pluck('name','id');
        $civilStates = CivilState::pluck('name','id');
        $countries = Country::pluck('name','id');
        $provinces = Province::pluck('name','id');
        $districts = District::pluck('name','id');
        $identityDocumentTypes = IdentityDocumentType::pluck('name','id');
        $departments = Department::pluck('name','id');
        $employeePositions = EmployeePosition::pluck('name','id');
        $employeeTypes = EmployeeType::pluck('name','id');
        $personPrefixes = PersonPrefix::pluck('code','id');
        return view('employees.create',compact('genders','civilStates','countries','provinces','districts','identityDocumentTypes','departments','employeePositions','employeeTypes','personPrefixes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEmployeeRequest $request,CreateEmployeeAction $createEmployee)
    {
        try{
            $employee = $createEmployee->execute($request->all());
        } catch (\Exception $e){
            dd($e);
            flash($e->getMessage())->error();
            return back()->withInput();
        }

        flash('Colaborador Criado com Sucesso')->success();
        return redirect()->route('employees.index');
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

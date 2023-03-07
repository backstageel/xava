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
use App\Models\EmployeeContractType;
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
        $contractTypes = EmployeeContractType::pluck('name','id');
        $personPrefixes = PersonPrefix::pluck('code','id');
        return view('employees.create',compact('genders','civilStates','countries','provinces','districts','identityDocumentTypes','departments','employeePositions','contractTypes','personPrefixes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEmployeeRequest $request,CreateEmployeeAction $createEmployee)
    {
        try{
            $createEmployee->execute($request->all());
            flash('Colaborador Criado com Sucesso')->success();
            return redirect()->route('employees.index');
        } catch (\Exception $e){
            flash($e->getMessage())->error();
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     * TODO colocar salario apenas para quem deve ver
     */
    public function show(Employee $employee)
    {
        $employee = $employee->load(['person.user','person.prefix']);
        return view('employees.show',compact('employee'));
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

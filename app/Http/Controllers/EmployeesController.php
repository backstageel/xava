<?php

namespace App\Http\Controllers;

use App\Actions\CreateEmployeeAction;
use App\Actions\EditEmployeeAction;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\EditEmployeeRequest;
use App\Models\CivilState;
use App\Models\Country;
use App\Models\Department;
use App\Models\District;
use App\Models\Employee;
use App\Models\EmployeeContractType;
use App\Models\EmployeePosition;
use App\Models\Gender;
use App\Models\IdentityDocumentType;
use App\Models\Person;
use App\Models\PersonPrefix;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with([
            'person.user',
            'employeePosition',
            'contractStatus',
            'contractType',
        ])->paginate(100);


        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genders = Gender::pluck('name', 'id');
        $civilStates = CivilState::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');
        $provinces = Province::pluck('name', 'id');
        $districts = District::pluck('name', 'id');
        $identityDocumentTypes = IdentityDocumentType::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');
        $employeePositions = EmployeePosition::pluck('name', 'id');
        $contractTypes = EmployeeContractType::pluck('name', 'id');
        $personPrefixes = PersonPrefix::pluck('code', 'id');
        return view(
            'employees.create',
            compact(
                'genders',
                'civilStates',
                'countries',
                'provinces',
                'districts',
                'identityDocumentTypes',
                'departments',
                'employeePositions',
                'contractTypes',
                'personPrefixes'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEmployeeRequest $request, CreateEmployeeAction $createEmployee)
    {
        $imagePath = null;
        $extension = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/profile_pictures');
            $extension = $request->file('image')->getClientOriginalExtension();
        }
        try {
            $createEmployee->execute($request->all(), $imagePath, $extension);
            flash('Colaborador Criado com Sucesso')->success();
            return redirect()->route('employees.index');
        } catch (\Exception $e) {
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
        $employee = $employee->load(['person.user', 'person.prefix']);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $this->user_id = Auth::user()->id;
        $this->person_id = Person::where('user_id',$this->user_id)->value('id');
        $this->employee_position_id = Employee::where('person_id',$this->person_id)->value('employee_position_id');

        if($this->employee_position_id == \App\Enums\EmployeePosition::GESTOR_ESCRITORIO || $this->user_id==1) {
            $genders = Gender::pluck('name', 'id');
            $civilStates = CivilState::pluck('name', 'id');
            $countries = Country::pluck('name', 'id');
            $provinces = Province::pluck('name', 'id');
            $districts = District::pluck('name', 'id');
            $identityDocumentTypes = IdentityDocumentType::pluck('name', 'id');
            $departments = Department::pluck('name', 'id');
            $employeePositions = EmployeePosition::pluck('name', 'id');
            $contractTypes = EmployeeContractType::pluck('name', 'id');
            $personPrefixes = PersonPrefix::pluck('code', 'id');

            return view('employees.edit', compact('employee', 'genders',
                'civilStates',
                'countries',
                'provinces',
                'districts',
                'identityDocumentTypes',
                'departments',
                'employeePositions',
                'contractTypes',
                'personPrefixes'));
        } else {
            flash('Desculpe, você não tem permissão para realizar esta ação.
             Por favor, entre em contato com o administrador para obter assistência.')->error();
            return redirect()->back()->withInput();

        }
    }

    /**
     * Update the specified resource in storage.
     */

        public function update(EditEmployeeRequest $request, Employee $employee, EditEmployeeAction $editEmployee)
    {


        if (!$employee) {
            flash('Colaborador não encontrado')->error();
            return redirect()->route('employees.show', $employee);
        }

        $imagePath = null;
        $extension = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/profile_pictures');
            $extension = $request->file('image')->getClientOriginalExtension();
        }

        try {
            $editEmployee->execute($request->all(), $employee, $imagePath, $extension);
            flash('Colaborador atualizado com sucesso')->success();
            return redirect()->route('employees.show', $employee);
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
            return back()->withInput();
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

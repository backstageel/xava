<?php

namespace App\Actions;
use App\Models\Employee;
use App\Models\EmployeeContract;
use App\Models\Person;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EditEmployeeAction
{

    public function execute(array $data, Employee $employee, $imagePath = null, $extension = null)
    {

        $person = Person::find($employee->person_id);
        $user = User::find($person->user_id);

        $user->email = $data['corporate_email'] ?? $data['personal_email'];
        $user->name = $data['first_name'] . ' ' . $data['last_name'];

        $person->person_prefix_id = $data['person_prefix_id'];
        $person->first_name = $data['first_name'];
        $person->last_name = $data['last_name'];
        $person->birth_date = $data['birth_date'];
        $person->gender_id = $data['gender_id'];
        $person->address = $data['address'];
        $person->address_district_id = $data['address_district_id'];
        $person->address_province_id = $data['address_province_id'];
        $person->address_country_id = $data['address_country_id'];
        $person->birth_district_id = $data['birth_district_id'];
        $person->birth_province_id = $data['birth_province_id'];
        $person->birth_country_id = $data['birth_country_id'];
        $person->phone = $data['cellphone'];
        $person->email = $data['personal_email'];
        $person->civil_state_id = $data['civil_state_id'];
        $person->nuit = $data['nuit'];
        $person->identity_document_type_id = $data['identity_document_type_id'];
        $person->identity_document_number = $data['identity_document_number'];
        $person->identity_document_emission_date = $data['identity_document_emission_date'];
        $person->identity_document_expiry_date = $data['identity_document_expiry_date'];


        if($extension != null){
            $newPath = 'profile_pictures/' . $person->id . '.' . $extension;
            Storage::move($imagePath, 'public/' . $newPath);
            $person->profile_picture = $newPath;
            $person->save();
        }


        $employee->emergency_name = $data['emergency_name'];
        $employee->emergency_phone = $data['emergency_phone'];
        $employee->employee_position_id = $data['employee_position_id'];
        $employee->department_id = $data['department_id'];
        $employee->start_date = $data['start_date'];
        $employee->base_salary = $data['base_salary'];
        $employee->contract_type_id = $data['contract_type_id'];


        $id = $employee->id;

        // Extrai o ano e o mês da data do contrato


        $startDate = Carbon::parse($employee->start_date); // Converte a data de início em um objeto Carbon

        $year = $startDate->format('y');
        $month = $startDate->format('m');


        // Monta a referência do funcionário
        $employeeCode = null;
        if ($id < 10) {
            $employeeCode = 'XV000' . $id . $month . $year;
        } elseif ($id < 100) {
            $employeeCode = 'XV00' . $id . $month . $year;
        } elseif ($id < 1000) {
            $employeeCode = 'XV0' . $id . $month . $year;
        } else {
            $employeeCode = 'XV' . $id . $month . $year;
        }

        $employee->employee_code = $employeeCode;


        $user->save();
        $person->save();
        $employee->save();
//        $contract->save();

        return $employee;
    }




/**
   * Create the action.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }


}

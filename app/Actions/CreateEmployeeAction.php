<?php

namespace App\Actions;

use App\Models\Employee;
use App\Models\EmployeeContract;
use App\Models\Person;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateEmployeeAction
{
  /**
   * Create the action.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Execute the action.
   *
   * @return void
   */
  public function execute($data)
  {
    //Create user
      $user = User::create([
          'email'=>$data['corporate_email']??$data['personal_email'],
          'name'=>$data['first_name'].' '.$data['last_name'],
          'password'=>Hash::make('12345')
      ]);
      //Create Person
      $person = Person::create([
          'user_id'=>$user->id,
            'person_prefix_id'=>$data['person_prefix_id'],
            'first_name'=>$data['first_name'],
            'last_name'=>$data['last_name'],
            'birth_date'=>$data['birth_date'],
            'gender_id'=>$data['gender_id'],
            'living_address'=>$data['living_address'],
            'living_district_id'=>$data['living_district_id'],
            'living_province_id'=>$data['living_province_id'],
            'living_country_id'=>$data['living_country_id'],
            'birth_district_id'=>$data['birth_district_id'],
            'birth_province_id'=>$data['birth_province_id'],
            'birth_country_id'=>$data['birth_country_id'],
            'cellphone'=>$data['cellphone'],
            'personal_email'=>$data['personal_email'],
            'civil_state_id'=>$data['civil_state_id'],
            'nuit'=>$data['nuit'],
            'identity_document_type_id'=>$data['identity_document_type_id'],
            'identity_document_number'=>$data['identity_document_number'],
            'identity_document_emission_date'=>$data['identity_document_emission_date'],
            'identity_document_expiry_date'=>$data['identity_document_expiry_date'],
      ]);

      $employee = Employee::create([
            'person_id'=>$person->id,
           'employee_code'=>$data['employee_code'],
          'emergency_name'=>$data['emergency_name'],
          'emergency_phone'=>$data['emergency_phone'],
          'employee_position_id'=>$data['employee_position_id'],
          'department_id'=>$data['department_id'],
          'start_date'=>$data['start_date'],
          'base_salary'=>$data['base_salary'],
          'contract_type_id'=>$data['contract_type_id'],
      ]);

      $contract = EmployeeContract::create([
            'employee_id'=>$employee->id,
          'contract_type_id'=>$data['contract_type_id'],
          'start_date'=>$data['start_date'],
          'base_salary'=>$data['base_salary'],
          'weekly_hours'=>$data['weekly_hours']??null,
          'benefits'=>$data['benefits']??null,
          'department_id'=>$data['department_id'],
          'employee_position_id'=>$data['employee_position_id'],

      ]);

      return $employee;
  }
}

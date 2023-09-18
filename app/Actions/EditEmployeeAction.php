<?php

namespace App\Actions;
use Illuminate\Support\Facades\Storage;

class EditEmployeeAction
{

    public function execute(array $data, Employee $employee, $imagePath = null, $extension = null)
    {
        // Atualize os campos do usuário (se necessário)
        if (isset($data['corporate_email'])) {
            $employee->user->email = $data['corporate_email'];
        } elseif (isset($data['personal_email'])) {
            $employee->user->email = $data['personal_email'];
        }
        if (isset($data['first_name']) && isset($data['last_name'])) {
            $employee->user->name = $data['first_name'] . ' ' . $data['last_name'];
        }

        // Atualize os campos da pessoa
        $employee->person->fill([
            'person_prefix_id' => $data['person_prefix_id'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'birth_date' => $data['birth_date'],
            'gender_id' => $data['gender_id'],
            'address' => $data['address'],
            'address_district_id' => $data['address_district_id'],
            'address_province_id' => $data['address_province_id'],
            'address_country_id' => $data['address_country_id'],
            'birth_district_id' => $data['birth_district_id'],
            'birth_province_id' => $data['birth_province_id'],
            'birth_country_id' => $data['birth_country_id'],
            'phone' => $data['cellphone'],
            'email' => $data['personal_email'],
            'civil_state_id' => $data['civil_state_id'],
            'nuit' => $data['nuit'],
            'identity_document_type_id' => $data['identity_document_type_id'],
            'identity_document_number' => $data['identity_document_number'],
            'identity_document_emission_date' => $data['identity_document_emission_date'],
            'identity_document_expiry_date' => $data['identity_document_expiry_date'],
        ]);

        // Se uma nova imagem for fornecida, atualize o caminho da imagem
        if ($imagePath && $extension) {
            // Lidar com o upload da nova imagem e atualizar o caminho da imagem no banco de dados
            $newPath = 'profile_pictures/' . $employee->person->id . '.' . $extension;
            Storage::move($imagePath, 'public/' . $newPath);
            $employee->person->profile_picture = $newPath;
        }

        // Atualize os campos do colaborador
        $employee->fill([
            'emergency_name' => $data['emergency_name'],
            'emergency_phone' => $data['emergency_phone'],
            'employee_position_id' => $data['employee_position_id'],
            'department_id' => $data['department_id'],
            'start_date' => $data['start_date'],
            'base_salary' => $data['base_salary'],
            'contract_type_id' => $data['contract_type_id'],
        ]);

        // Salvar as alterações
        $employee->user->save();
        $employee->person->save();
        $employee->save();

        // Atualize o contrato do colaborador (se necessário)
        $contract = $employee->contract;
        if ($contract) {
            $contract->fill([
                'contract_type_id' => $data['contract_type_id'],
                'start_date' => $data['start_date'],
                'base_salary' => $data['base_salary'],
                'weekly_hours' => $data['weekly_hours'] ?? null,
                'benefits' => $data['benefits'] ?? null,
                'department_id' => $data['department_id'],
                'employee_position_id' => $data['employee_position_id'],
            ]);
            $contract->save();
        }

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

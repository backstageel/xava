<?php

    use App\Models\User;

    beforeEach(function () {
        $user = User::factory()->create();
        $this->actingAs($user);
    });

    test('new employees can register', function () {

        $data = [
            "last_name" => "Leonardo",
            "first_name" => "Elisio",
            "person_prefix_id" => "1",
            "employee_code" => "111",
            "gender_id" => "1",
            "birth_date" => "2023-02-01",
            "civil_state_id" => "2",
            "birth_country_id" => "152",
            "birth_province_id" => "6",
            "birth_district_id" => "101",
            "identity_document_type_id" => "1",
            "identity_document_number" => "436435345",
            "identity_document_emission_date" => "2023-02-15",
            "identity_document_expiry_date" => null,
            "start_date" => "2023-02-26",
            "contract_type_id" => "1",
            "base_salary" => "435353",
            "nuit" => "123456789",
            "corporate_email" => "teste@xava.co.mz",
            "emergency_name" => "Elisio Leonardo",
            "emergency_phone" => "34353453",
            "living_address" => "35435345",
            "living_country_id" => "152",
            "living_province_id" => "1",
            "living_district_id" => "101",
            "cellphone" => "3453535",
            "personal_email" => "elisio.leonardo@gmail.com",
            'department_id'=>1,
            'employee_position_id'=>1
        ];
        $response = $this->post(route('employees.store'),$data);
        $this->assertDatabaseHas('users',['email'=>'teste@xava.co.mz']);
        $this->assertDatabaseHas('people',['nuit'=>'123456789']);
        $this->assertDatabaseHas('employees',['start_date'=>'2023-02-26']);

        $employee = \App\Models\Employee::latest()->first();
        $this->assertDatabaseHas('employee_contracts',['start_date'=>'2023-02-26','employee_id'=>$employee->id]);
        $response->assertStatus(302);
});

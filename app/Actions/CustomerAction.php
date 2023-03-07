<?php

namespace App\Actions;

use App\Models\Customer;
use App\Models\Person;


class CustomerAction
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

        //Create Person
        $person = Person::create([

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

        $customer = Customer::create([
            'person_id'=>$person->id,
            'status'=>$data['status'],
            'nuit'=>$data['nuit'],
            'customer_type_id'=>$data['customer_type_id'],

        ]);



        return $customer;
    }
}

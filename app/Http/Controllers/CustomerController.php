<?php

namespace App\Http\Controllers;

use App\DataTables\CustomersDataTable;
use App\Models\CivilState;
use App\Models\Country;

use App\Models\District;

use App\Models\Gender;
use App\Models\IdentityDocumentType;
use App\Models\PersonPrefix;
use App\Models\Province;
use App\Models\CustomerType;

class CustomerController extends Controller
{
    public function index(CustomersDataTable $dataTable){
        return $dataTable->render('customers.index');
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
        //$avenues = Avenue::pluck('name','id');
        $customer_types= CustomerType::pluck('name', 'id');
        $identityDocumentTypes = IdentityDocumentType::pluck('name','id');



        $personPrefixes = PersonPrefix::pluck('code','id');
        return view('customers.create',compact('genders','civilStates','countries','provinces','districts','identityDocumentTypes','personPrefixes', 'customer_types'));
    }

}



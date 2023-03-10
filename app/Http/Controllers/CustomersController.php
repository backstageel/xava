<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Company;
use App\Models\Country;
use App\Models\Customer;
use App\Models\District;
use App\Models\Person;
use App\Models\Province;

class CustomersController extends Controller
{
    public function index(){
        $customers = Customer::withCustomerable()->orderByDesc('created_at')->paginate();

        return view('customers.index',compact('customers'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::pluck('name','id');
        $provinces = Province::pluck('name','id');
        $districts = District::pluck('name','id');
        $customerTypes = [1=>'Empresa',2=>'Individual'];

        return view('customers.create',compact('countries','provinces','districts', 'customerTypes',));
    }

    public function store(CustomerRequest $request)
    {
        $customerType = $request->input(['customer_type']);
        if($customerType==1){
            $customerable = new Company();
            $customerable->name = $request->input('name');
            $customerable->website=$request->input('website');
            $customerableType = Company::class;
        } else{
            $customerable = new Person();
            [$customerable->first,$customerable->last_name] = split_name($request->input('name'));
            $customerableType = Person::class;
        }
        $customerable->email = $request->input('email');
        $customerable->nuit = $request->input('nuit');
        $customerable->phone = $request->input('phone');
        $customerable->address_country_id=$request->input('country_id');
        $customerable->address_province_id=$request->input('province_id');
        $customerable->address_district_id=$request->input('district_id');
        $customerable->save();

        $customer = new Customer();
        $customer->customerable_id = $customerable->id;
        $customer->customerable_type = $customerableType;
        $customer->save();
        flash('Fornecedor registado com sucesso')->success();
        return redirect()->route('customers.index');
    }

    public function show(Customer $customer)
    {
        $customer = $customer->load(['person.user','person.prefix']);
        return view('customers.show',compact('customer'));
    }
}



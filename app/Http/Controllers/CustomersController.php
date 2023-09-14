<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Company;
use App\Models\Country;
use App\Models\Customer;
use App\Models\District;
use App\Models\Gender;
use App\Models\Person;
use App\Models\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomersController extends Controller
{
    use SoftDeletes;

    public function index()
    {
        $customers = Customer::withCustomerable()->orderByDesc('created_at')->paginate();

        return view('customers.index', compact('customers'));
    }


    public function create()
    {
        $countries = Country::pluck('name', 'id');
        $provinces = Province::pluck('name', 'id');
        $districts = District::pluck('name', 'id');
        $customerTypes = [1 => 'Estado', 2 => 'ONG', 3 => 'Privado', 4 => 'Particular'];
        $genders = Gender::pluck('name', 'id');


        return view('customers.create', compact('countries', 'provinces', 'districts', 'customerTypes', 'genders'));
    }

    public function store(CustomerRequest $request)
    {
        $customerType = $request->input(['customer_type']);
        if ($customerType == 1 || $customerType == 2 || $customerType == 3) {
            $customerable = new Company();
            $customerable->name = $request->input('name');
            $customerable->website = $request->input('website');
            $customerableType = Company::class;

        } else {
            $customerable = new Person();
            [$customerable->first_name, $customerable->last_name] = split_name($request->input('name'));
            $customerable->gender_id = $request->input('gender_id');
            $customerableType = Person::class;
        }
        $customerable->email = $request->input('email');
        $customerable->nuit = $request->input('nuit');
        $customerable->phone = $request->input('phone');
        $customerable->address_country_id = $request->input('country_id');
        $customerable->address_province_id = $request->input('province_id');
        $customerable->address_district_id = $request->input('district_id');

        if(strlen($customerable->nuit)!=9  && ($customerable->nuit)!= null){
            flash('Nuit invalido, o campo Nuit deve ser composto por 9 dígitos')->error();
            return redirect()->route('customers.create');
        }else {
            $customerable->save();
        }


        $customer = new Customer();
        $customer->customerable_id = $customerable->id;
        $customer->customerable_type = $customerableType;
        if($customerType == 1){
            $customer->customer_type = "Estado";
        } else if($customerType == 2){
            $customer->customer_type = "ONG";
        } else if($customerType == 3){
            $customer->customer_type = "Privado";
        }else{
            $customer->customer_type = "Particular";
        }
        $customer->save();
        flash('Fornecedor registado com sucesso')->success();
        return redirect()->route('customers.index');
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        if ($customer->customerable_type == Company::class) {
            $companyData = $request->except('_token', '_method');
            $company = Company::where('id', $customer->customerable_id)->first();
            $company->update($companyData);
        } else {
            $personData = $request->except('_token', '_method');
            $person = Person::where('id', $customer->customerable_id)->first();

            $person->update($personData);
        }
        flash('Cliente editado com sucesso')->success();
        return redirect()->route('customers.index');
    }

    public function edit(Customer $customer)
    {
        $countries = Country::pluck('name', 'id');
        $provinces = Province::pluck('name', 'id');
        $districts = District::pluck('name', 'id');
        $genders = Gender::pluck('name', 'id');

        if ($customer->customerable_type == Company::class) {
            $company = Company::with(['companyType', 'livingDistrict', 'livingProvince', 'livingCountry'])
                ->where('id', $customer->customerable_id)->first();
            return view(
                'customers.edit_company',
                compact('customer', 'company', 'countries', 'provinces', 'districts')
            );
        } else {
            $person = Person::with(['prefix', 'gender'])
                ->where('id', $customer->customerable_id)->first();
            return view(
                'customers.edit_person',
                compact('customer', 'person', 'genders', 'countries', 'provinces', 'districts')
            );
        }
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function destroy(Customer $customer)
    {

        try {
            $customer->delete();
            flash('Cliente removido com sucesso')->success();
            return redirect()->route('customers.index');
        } catch (\Exception $exception) {
            flash('Erro ao Deletar Cliente: ' . $exception->getMessage())->error();
            return redirect()->back()->withInput();
        }

    }
}



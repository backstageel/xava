<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Company;
use App\Models\Competition;
use App\Models\Country;
use App\Models\Customer;
use App\Models\District;
use App\Models\Employee;
use App\Models\Gender;
use App\Models\Person;
use App\Models\Province;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
{
    use SoftDeletes;
    private $user_id, $person_id, $employee_position_id;

    public function index()
    {
        $customers = Customer::withCustomerable()->orderByDesc('created_at')->paginate(1000);

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
            return redirect()->back()->withInput();
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

        $this->user_id = Auth::user()->id;
        $this->person_id = Person::where('user_id',$this->user_id)->value('id');
        $this->employee_position_id = Employee::where('person_id',$this->person_id)->value('employee_position_id');

        if($this->employee_position_id == \App\Enums\EmployeePosition::GESTOR_ESCRITORIO || $this->user_id==1
           || $this->employee_position_id == \App\Enums\EmployeePosition::DIRECTOR_OPERATIVO) {

            // Verificar se existem vendas relacionadas a este cliente
            $hasSales = Sale::where('customer_id', $customer->id)->exists();

            // Verificar se existem concursos relacionados a este cliente
            $hasCompetition = Competition::where('customer_id', $customer->id)->exists();

            if ($hasSales || $hasCompetition) {
                flash('Este cliente possui vendas ou concursos relacionados e não pode ser excluído.')->error();
                return redirect()->back();
            }

            try {
                $customer->delete();
                flash('Cliente removido com sucesso')->success();
                return redirect()->route('customers.index');
            } catch (\Exception $exception) {
                flash('Erro ao Deletar Cliente: ' . $exception->getMessage())->error();
                return redirect()->back()->withInput();
            }

        } else {
            flash('Desculpe, você não tem permissão para realizar esta ação.
            Por favor, entre em contato com o administrador para obter assistência.')->error();
            return redirect()->back()->withInput();
        }
    }
}



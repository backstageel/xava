<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupplierRequest;
use App\Models\Company;
use App\Models\Country;
use App\Models\District;
use App\Models\Person;
use App\Models\Province;
use App\Models\Supplier;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::withSupplierable()->paginate(1000);
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::pluck('name', 'id');
        $provinces = Province::pluck('name', 'id');
        $districts = District::pluck('name', 'id');

        $supplierTypes = [1 => 'Empresa', 2 => 'Individual'];

        return view('suppliers.create', compact('countries', 'provinces', 'districts', 'supplierTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSupplierRequest $request)
    {
        $supplierType = $request->input(['supplier_type']);
        if ($supplierType == 1 ) {
            $supplierable = new Company();
            $supplierable->name = $request->input('name');
            $supplierable->website = $request->input('website');
            $supplierableType = Company::class;
        } else {
            $supplierable = new Person();
            [$supplierable->first_name, $supplierable->last_name] = split_name($request->input('name'));
            $supplierable->gender_id = 1;
            $supplierableType = Person::class;
        }
        $supplierable->email = $request->input('email');
        $supplierable->nuit = $request->input('nuit');
        $supplierable->phone = $request->input('phomne');
        $supplierable->address_country_id = $request->input('country_id');
        $supplierable->address_province_id = $request->input('province_id');
        $supplierable->address_district_id = $request->input('district_id');
        if ( $supplierable->nuit != null && strlen($supplierable->nuit) != 9){
            flash('Nuit invalido, o campo Nuit deve ser composto por 9 dígitos')->error();
            return redirect()->route('suppliers.create');
        } else {
            $supplierable->save();
        }

        $supplier = new Supplier();
        $supplier->supplierable_id = $supplierable->id;
        $supplier->supplierable_type = $supplierableType;


        $supplier->save();
        flash('Fornecedor registado com sucesso')->success();
        return redirect()->route('suppliers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        $countries = Country::pluck('name', 'id');
        $provinces = Province::pluck('name', 'id');
        $districts = District::pluck('name', 'id');
        $supplierTypes = [1 => 'Empresa', 2 => 'Individual'];

        return view('suppliers.edit', compact('supplier',  'supplierTypes','countries', 'provinces', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateSupplierRequest $request, Supplier $supplier)
    {
//        $companyData = $request->except('_token', '_method');
//        $company = Company::where('id', $supplier->supplierable_id)->first();
//        $company->update($companyData);

        $supplierType = $request->input(['supplier_type']);
//        if ($supplierType == 1 ) {
//            $supplierable = new Company();
//            $supplierable->name = $request->input('name');
//            $supplierable->website = $request->input('website');
//            $supplierableType = Company::class;
//        } else {
//            $supplierable = new Person();
//            [$supplierable->first_name, $supplierable->last_name] = split_name($request->input('name'));
//            $supplierable->gender_id = 1;
//            $supplierableType = Person::class;
//        }
        $supplier->supplierable->email = $request->input('email');
        $supplier->supplierable->nuit = $request->input('nuit');
        $supplier->supplierable->phone = $request->input('phomne');
        $supplier->supplierable->address_country_id = $request->input('country_id');
        $supplier->supplierable->address_province_id = $request->input('province_id');
        $supplier->supplierable->address_district_id = $request->input('district_id');
        if ( $supplier->supplierable->nuit != null && strlen($supplier->supplierable->nuit) != 9){
            flash('Nuit invalido, o campo Nuit deve ser composto por 9 dígitos')->error();
            return redirect()->route('suppliers.create');
        } else {
            $supplier->supplierable->save();
        }

//        $supplier->supplierable_id = $supplierable->id;

        if ($supplierType == 1 ) {
            $supplier->supplierable_type = Company::class;
        } else {
            $supplier->supplierable_type = Person::class;
        }
        $supplier->save();



        $supplier->save();
        flash('Fornecedor editado com sucesso')->success();
        return redirect()->route('suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupplierRequest;
use App\Models\Company;
use App\Models\Country;
use App\Models\Customer;
use App\Models\District;
use App\Models\Person;
use App\Models\Province;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers=Supplier::withSupplierable()->paginate();
        return view('suppliers.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $countries = Country::pluck('name','id');
        $provinces = Province::pluck('name','id');
        $districts = District::pluck('name','id');

        $supplierTypes = [1=>'Empresal',2=>'Individual'];
        return view('suppliers.create',compact('countries','provinces','districts','supplierTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSupplierRequest $request)
    {
        $supplierType = $request->input(['supplier_type']);
        if($supplierType==1){
            $supplierable = new Company();
            $supplierable->name = $request->input('name');
            $supplierable->website=$request->input('website');
            $supplierableType = Company::class;
        } else{
            $supplierable = new Person();
            [$supplierable->first,$supplierable->last_name] = split_name($request->input('name'));
            $supplierableType = Person::class;
        }
        $supplierable->email = $request->input('email');
        $supplierable->nuit = $request->input('nuit');
        $supplierable->phone = $request->input('phone');
        $supplierable->address_country_id=$request->input('country_id');
        $supplierable->address_province_id=$request->input('province_id');
        $supplierable->address_district_id=$request->input('district_id');
        $supplierable->save();

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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

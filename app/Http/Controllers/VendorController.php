<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorRequest;
use App\Models\Country;
use App\Models\District;
use App\Models\Province;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors=Vendor::paginate();
        return view('vendors.index',compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $countries = Country::pluck('name','id');
        $provinces = Province::pluck('name','id');
        $districts = District::pluck('name','id');
        return view('vendors.create',compact('countries','provinces','districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VendorRequest $request)
    {
        $vendor=new Vendor();
        $vendor->name=$request->input('name');
        $vendor->email=$request->input('email');
        $vendor->phone_number_1=$request->input('phone_number_1');
        $vendor->phone_number_2=$request->input('phone_number_2');
        $vendor->nuit=$request->input('nuit');
        $vendor->country_id=$request->input('country_id');
        $vendor->province_id=$request->input('province_id');
        $vendor->district_id=$request->input('district_id');
        $vendor->web=$request->input('web');

        $vendor->save();
        flash('Fornecedor registado com sucesso')->success();
        return redirect()->route('vendors.index');
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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerTypeRequest;
use App\Models\CustomerType;
use Illuminate\Http\Request;

class CustomerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $customersTypes = CustomerType::paginate();
        return view('customer_types.index', compact('customersTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerTypeRequest $request)
    {
        $customerType = new CustomerType();
        $customerType->name = $request->input('name');
        $customerType->save();
        flash('Tipo de cliente registado com sucesso')->success();
        return redirect()->route('customer_types.index');
        //
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

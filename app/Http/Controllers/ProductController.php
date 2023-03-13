<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerTypeRequest;
use App\Http\Requests\ProductRequest;
use App\Models\CategoryProduct;
use App\Models\CivilState;
use App\Models\Country;
use App\Models\CustomerType;
use App\Models\Department;
use App\Models\District;
use App\Models\EmployeeContractType;
use App\Models\EmployeePosition;
use App\Models\Gender;
use App\Models\IdentityDocumentType;
use App\Models\PersonPrefix;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Province;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::paginate();
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category=ProductCategory::pluck('name','id');
        $countries = Country::pluck('name','id');
        return view('products.create',compact('category','countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product=new Product();
        $product->name=$request->input('name');
        $product->reference=$request->input('reference');
        $product->description=$request->input('description');
        $product->brand=$request->input('brand');
        $product->sale_price=$request->input('sale_price');
        $product->purchase_price=$request->input('purchase_price');
        $product->category_id=$request->input('category_id');
        $product->save();
        flash('Produto registado com sucesso')->success();
        return redirect()->route('products.index');
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

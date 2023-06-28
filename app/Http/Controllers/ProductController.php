<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\CategoryProduct;
use App\Models\Country;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products= Product::with(['ProductCategory'])->paginate(1000);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $category = ProductCategory::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');
        return view('products.create', compact('category', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {

        $product = new Product();


        $product->name = $request->input('name');
        $product->reference = $request->input('reference');
        $product->description = $request->input('description');
        $product->brand = $request->input('brand');

        $product->category_id = $request->input('category_id');


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
    public function edit(Product $product)
    {
        $category = ProductCategory::pluck('name', 'id');

        return view('products.edit', compact('category', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if(($request->input('description')) != null){
            $product->description = $request->input('description');
        }



        if(($request->input('brand')) != null){
            $product->brand = $request->input('brand');
        }
        if(( $request->input('category_id')) != null){
            $product->category_id = $request->input('category_id');
        }


        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

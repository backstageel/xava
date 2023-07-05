<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Country;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;

class ProductSubCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $product_sub_categories= ProductSubCategory::with(['ProductCategory'])->paginate(1000);
        return view('product_sub_categories.index', compact('product_sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        $ids = [11,3]; // Lista de IDs desejados
        $minId = 33; // ID mínimo desejado

        $category = ProductCategory::where(function ($query) use ($ids, $minId) {
            $query->whereIn('id', $ids)
                ->orWhere('id', '>', $minId);
        })->orderBy('name')->pluck('name', 'id');

        return view('product_sub_categories.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {

        $product_sub_category = new ProductSubCategory();


        $product_sub_category->name = $request->input('name');
        $product_sub_category->product_category_id = $request->input('category_id');



        $product_sub_category->save();
        flash('Sub Categoria do Produto registado com sucesso')->success();
        return redirect()->route('product_sub_categories.index');
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
    public function edit(ProductSubCategory $product_sub_category)
    {

        $ids = [11,3]; // Lista de IDs desejados
        $minId = 33; // ID mínimo desejado

        $category = ProductCategory::where(function ($query) use ($ids, $minId) {
            $query->whereIn('id', $ids)
                ->orWhere('id', '>', $minId);
        })->orderBy('name')->pluck('name', 'id');

        return view('product_sub_categories.edit', compact('category', 'product_sub_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductSubCategory $product_sub_category)
    {
        if(($request->input('name')) != null){
            $product_sub_category->name = $request->input('name');
        }
        if(($request->input('category_id')) != null){
            $product_sub_category->product_category_id = $request->input('category_id');
        }

        $product_sub_category->save();
        flash('Sub Categoria actualizado  com sucesso')->success();
        return redirect()->route('product_sub_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}

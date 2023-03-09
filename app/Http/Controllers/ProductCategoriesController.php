<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategory;

class ProductCategoriesController extends Controller
{
    public function index()
    {
        //
        $categorysProducts=ProductCategory::paginate();
        return view('product_categories.index', compact('categorysProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryRequest $request)
    {
        $category = new ProductCategory();
        $category->name = $request->input('name');
        $category->save();
        flash('Tipo de Categoria Registado com sucesso')->success();
        return redirect()->route('product_categories.index');
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
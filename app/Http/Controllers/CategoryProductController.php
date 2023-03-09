<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryProductRequest;
use App\Models\CategoryProduct;

class CategoryProductController extends Controller
{
    public function index()
    {
        //
        $categoryProducts=CategoryProduct::paginate();
        return view('category_products.index', compact('categoryProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category_products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryProductRequest $request)
    {
        $category = new CategoryProduct();
        $category->name = $request->input('name');
        $category->save();
        flash('Tipo de Categoria Registado com sucesso')->success();
        return redirect()->route('category_products.index');
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

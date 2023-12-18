<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Exports\SaleExport;
use App\Http\Requests\ProductRequest;
use App\Models\CategoryProduct;
use App\Models\Country;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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


        $ids = [11,3]; // Lista de IDs desejados
        $minId = 33; // ID mínimo desejado

        $category = ProductCategory::where(function ($query) use ($ids, $minId) {
            $query->whereIn('id', $ids)
                ->orWhere('id', '>', $minId);
        })->orderBy('name')->pluck('name', 'id');
        $countries = Country::pluck('name', 'id');
        return view('products.create', compact('category', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {

        $product = new Product();

        $last_Id = Product::latest()->value('id');
        $product->name = $request->input('name');
        $product->reference = ('PXV' . (1 + $last_Id));
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

        $ids = [11,3]; // Lista de IDs desejados
        $minId = 33; // ID mínimo desejado

        $category = ProductCategory::where(function ($query) use ($ids, $minId) {
            $query->whereIn('id', $ids)
                ->orWhere('id', '>', $minId);
        })->orderBy('name')->pluck('name', 'id');

        return view('products.edit', compact('category', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if(($request->input('name')) != null){
            $product->name = $request->input('name');
        }
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
        flash('Produto actualizado  com sucesso')->success();
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function export(){
        return Excel::download(new ProductExport, 'productos.xlsx');
    }
}

<?php

namespace App\Http\Controllers;


use App\Models\Company;
use App\Models\Customer;
use App\Models\Person;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SaleStatus;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use App\Http\Requests\SaleItemsRequest;
use App\Http\Requests\SaleRequest;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use App\Models\Sale;



class SaleItemsController extends Controller
{




    public function index()
    {

    }


    public function create(Sale $sale)
    {
        $products = Product::pluck('name', 'id');
        return view('sale_items.create', compact('sale', 'products'));


    }


    public function store(SaleItemsRequest $request)
    {
            $sale_items = new SaleItem();
            $sale_items->sale_id = $request->input('sale_id');
            $sale_items->product_id = $request->input('product_id');
            $sale_items->quantity = $request->input('quantity');
            $sale_items->unit_price = $request->input('unit_price');
            $sale_items->purchase_price = $request->input('purchase_price');
            $sale_items->sub_total = $sale_items->unit_price * $sale_items->quantity;
            $sale_items->save();

            $sale = Sale::where('id', $sale_items->sale_id)->first();
            $sale->total_amount = $sale->total_amount + $sale_items->sub_total;
            $sale->debt_amount = $sale->total_amount - $sale->amount_received;
            $products = Product::pluck('name', 'id');

            try{
            $sale->save();

            flash('Produto Adicionado')->success();
            return view('sale_items.create', compact('sale', 'products'));
            } catch (\Exception $exception) {
                flash('Erro ao Adicionar Produto: ' . $exception->getMessage())->error();
                return redirect()->back()->withInput();
            }


    }


    public function show(SaleItem $sale)
    {

        $sale_items = SaleItem::with(['product'])->
        where('sale_id', $sale->id)->get();
        return view('sales.show', compact('sale', 'sale_items'));
    }


    public function edit(SaleItem $sale_item)
    {
        $products = Product::pluck('name', 'id');
        return view('sale_items.edit', compact('sale_item', 'products'));
    }


    public function update(SaleItemsRequest $request, SaleItem $sale_item)
    {

        $sale_item->product_id = $request->input('product_id');
        $old_sale_sub_total = $sale_item->sub_total;


        if (($request->input('quantity')) != null) {
            $sale_item->quantity = $request->input(['quantity']);
        }
        if (($request->input('unit_price')) != null) {
            $sale_item->unit_price = $request->input('unit_price');
        }

        if (($request->input('purchase_price')) != null) {
            $sale_item->purchase_price = $request->input('purchase_price');
        }

        $sale_item->sub_total = $sale_item->unit_price * $sale_item->quantity;

        try{
            $sale_item->save();
            $sale = Sale::where('id', $sale_item->sale_id)->first();

            $sale->total_amount = $sale->total_amount - $old_sale_sub_total + $sale_item->sub_total;
            $sale->debt_amount = $sale->total_amount - $sale->amount_received;
            $sale->save();

            $sale_items = SaleItem::with(['product'])->
            where('sale_id', $sale->id)->get();

            flash('Produto Actualizado')->success();
            return view('sales.show', compact('sale', 'sale_items'));
        } catch (\Exception $exception) {
            flash('Erro ao Actualizar Produto: ' . $exception->getMessage())->error();
            return redirect()->back()->withInput();
        }



        return redirect()->route('sales.index');
    }


    public function destroy(string $id)
    {
        //
    }


}

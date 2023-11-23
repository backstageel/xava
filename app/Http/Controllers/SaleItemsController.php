<?php

namespace App\Http\Controllers;



use App\Models\Product;

use App\Models\SaleItem;
use App\Models\SaleStatus;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\SaleItemsRequest;
use App\Http\Requests\SaleRequest;

use App\Models\Sale;



class SaleItemsController extends Controller
{




    public function index()
    {

    }


    public function create()
    {
    }


    public function store(SaleItemsRequest $request)
    {
            $sale_items = new SaleItem();
            $sale_items->sale_id = $request->input('sale_id');
            $sale_items->product_id = $request->input('product_id');
            $sale_items->quantity = $request->input('quantity');

            if (($request->input('unit_price')) != null) {
                if (is_numeric($request->input('unit_price'))) {
                    $sale_items->unit_price = $request->input('unit_price');
                } else {
                    flash('Produto não adicionado. Formatação do campo "Preco Unitario de Venda" incorrecto.
                    Separação de casas decimais para campos númericos: (0.0)')->error();
                    return redirect()->back()->withInput();
                }
            }
            if (($request->input('purchase_price')) != null) {
                if (is_numeric($request->input('purchase_price'))) {
                    $sale_items->purchase_price = $request->input('purchase_price');
                } else {
                    flash('Produto não adicionado. Formatação do campo "Preco de Compra" incorrecto.
                        Separação de casas decimais para campos númericos: (0.0)')->error();
                    return redirect()->back()->withInput();
                }
            }

            if (($request->input('supplier_id')) != null) {
                    $sale_items->supplier_id = $request->input('supplier_id');
            }

            $sale_items->sub_total = $sale_items->unit_price * $sale_items->quantity;
            $sale_items->total_purchase_price = $sale_items->purchase_price * $sale_items->quantity;



            $sale = Sale::where('id', $sale_items->sale_id)->first();
            $sale->total_amount = $sale->total_amount + $sale_items->sub_total;
            $sale->debt_amount = $sale->total_amount - $sale->amount_received;
            $sale->purchase_price = $sale->purchase_price + $sale_items->total_purchase_price;

            if ($sale->sale_status_id ==  SaleStatus::where('name', 'Facturado')->value('id')
                || $sale->sale_status_id == SaleStatus::where('name', 'Pago')->value('id'))
            {
                $sale->profit = $sale->total_amount - $sale->purchase_price - $sale->transport_value-
                    $sale->other_expenses - $sale->tax - $sale->intermediary_committee;
            }

            $products = Product::pluck('name', 'id');

            try{
                $sale_items->save();
                $sale->save();
                $suppliers = Supplier::with('supplierable')->get()->pluck('supplierable.name', 'id');
                flash('Produto Adicionado')->success();
                return view('sale_items.create', compact('sale', 'products', 'suppliers'));

            } catch (\Exception $exception) {
                flash('Erro ao Adicionar Produto: ' . $exception->getMessage())->error();
                return redirect()->back()->withInput();
            }



    }


    public function show(Sale $sale)
    {
        $products = Product::pluck('name', 'id');
        return view('sale_items.create', compact('sale', 'products'));


    }


    public function edit(SaleItem $sale_item)
    {
        $products = Product::pluck('name', 'id');
        $suppliers = Supplier::with('supplierable')->get()->pluck('supplierable.name', 'id');
        return view('sale_items.edit', compact('sale_item', 'products', 'suppliers'));
    }


    public function update(SaleItemsRequest $request, SaleItem $sale_item)
    {

        $sale_item->product_id = $request->input('product_id');
        $old_sale_sub_total = $sale_item->sub_total;


        if (($request->input('quantity')) != null) {
            $sale_item->quantity = $request->input(['quantity']);
        }
        if (($request->input('supplier_id')) != null) {
            $sale_item->supplier_id = $request->input('supplier_id');
        }
        if (($request->input('unit_price')) != null) {
            if (is_numeric($request->input('unit_price'))) {
                $sale_item->unit_price = $request->input('unit_price');
            } else {
                flash('Produto não atualizado. Formatação do campo "Preco Unitario de Venda" incorrecto.
                    Separação de casas decimais para campos númericos: (0.0)')->error();
                return redirect()->back()->withInput();
            }
        }
        if (($request->input('purchase_price')) != null) {
            if (is_numeric($request->input('purchase_price'))) {
                $sale_item->purchase_price = $request->input('purchase_price');
            } else {
                flash('Produto não atualizado. Formatação do campo "Preco de Compra" incorrecto.
                    Separação de casas decimais para campos númericos: (0.0)')->error();
                return redirect()->back()->withInput();
            }
        }




        $sale_item->sub_total = $sale_item->unit_price * $sale_item->quantity;
        $sale_item->total_purchase_price = $sale_item->purchase_price * $sale_item->quantity;

        try{
            $sale_item->save();
            $sale = Sale::where('id', $sale_item->sale_id)->first();

            $sale->total_amount = $sale->total_amount - $old_sale_sub_total + $sale_item->sub_total;
            $sale->debt_amount = $sale->total_amount - $sale->amount_received;
            $sale->save();

            $sale_items = SaleItem::with(['product', 'supplier.supplierable'])->
            where('sale_id', $sale->id)->get();

            flash('Produto Actualizado')->success();
            return view('sales.show', compact('sale', 'sale_items'));
        } catch (\Exception $exception) {
            flash('Erro ao Actualizar Produto: ' . $exception->getMessage())->error();
            return redirect()->back()->withInput();
        }

    }


    public function destroy(string $id)
    {
        //
    }


}

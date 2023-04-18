<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\SaleStatus;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use App\Http\Requests\SaleRequest;
use App\Models\Sale;

class SaleController extends Controller
{
    public function index()
    {

        $sales = Sale::with([ 'customer','saleItem.product', 'saleStatus'])->paginate(20);
        return view('sales.index', compact('sales'));
    }



    public function create()
    {

        #$customers = Customer::withCustomerable()->orderByDesc('created_at');
        #foreach ($customers as $customer) {
        #   if ($customer->customerable->name == null){
        #     $array = [$customer->id => $customer->customerable->first_name + " " + $customer->customerable->last_name];
        #  }else{
        #    $array = [$customer->id => $customer->customerable->name];
        # }

        #}
        $customers = Customer::pluck('id');
       # $customers = Customer::withCustomerable()->selectRaw('IFNULL(name,
        #CONCAT_WS(first_name, " ", last_name)) as full_name')
        #->wherehasMorph('customerable', '*',function ($query){
         #   $query->select('id');
        #})->get();

        $sale_statuses = SaleStatus::pluck('name', 'id');
        return view(
            'sales.create',
            compact(
                'customers',

                'sale_statuses'

            )
        );
    }






    public function store(SaleRequest $request)
    {
        if($request->has('create_sale')){
            $sale = new Sale();
            $sale->sale_ref = $request->input(['sale_ref']);
            $sale->customer_id = $request->input('customer_id');
            $sale->sale_date = $request->input('sale_date');
            $sale->sale_status_id = $request->input('sale_status_id');
            $sale->notes = $request->input('notes');
            $sale->payment_method= $request->input('payment_method');
            $sale->total_amount= 0.00;
            $sale->save();

            $products = Product::pluck('name', 'id');
            return view('sales.choose_products', compact('sale', 'products'));
        } else if($request->has('form_products')){
            $sale_items = new SaleItem();
            $sale_items->sale_id = $request->input('sale_id');
            $sale_items->product_id = $request->input('product_id');
            $sale_items->quantity = $request->input('quantity');
            $sale_items->unit_price = $request->input('unit_price');
            $sale_items->sub_total = $sale_items->unit_price * $sale_items->quantity;

            $sale = Sale::where('id', $sale_items->sale_id)->first();
            $sale->total_amount=$sale->total_amount + $sale_items->sub_total;
            $products = Product::pluck('name', 'id');

            flash('Produto Adicionado')->success();
            return view('sales.choose_products', compact('sale', 'products'));
        }
        flash('Erro')->error();
        return redirect()->route('sales.index');

    }


    public function show(Sale $sale)
    {
        $sale = Sale::with([ 'customer','saleItem.product', 'saleStatus']);
        return view('sales.show', compact('sale'));
    }


    public function edit(Sale $sale)
    {

    }


    public function update(LoanRequest $request, Loan $loan)
    {

    }


    public function destroy(string $id)
    {
        //
    }
}

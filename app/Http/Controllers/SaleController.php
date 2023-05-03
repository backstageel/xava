<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Person;
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

        $company_names = Company::pluck('name');
        $id_customer_company = Customer::where('customerable_type', 'App\Models\Company')->get()->pluck('id');
        $company = array_combine( ($id_customer_company)->toArray(), $company_names->toArray());

        $customers_person = Customer::all();
        $id_customer_person =  Customer::where('customerable_type', 'App\Models\Person')->get()->pluck('id');
        $person_names = Person::whereIn('id', $customers_person->pluck('customerable_id'))
            ->selectRaw("CONCAT(first_name, ' ', last_name) as full_name")->pluck('full_name');

        $person = array_combine( ($id_customer_person)->toArray(), $person_names->toArray());
        $customers = $company+  $person;
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
            $customer= Customer::where('id', $sale->customer_id)->first();

            if ($customer->customerable_type == Company::class) {
                $company =  Company::where('id', $customer->customerable_id)->first();
                $sale->customer_name =$company->name;
            } else {
                $person =  Person::where('id', $customer->customerable_id)->first();
                $sale->customer_name = $person->first_name.$person->last_name;
            }

            $sale->sale_date = $request->input('sale_date');
            $sale->sale_status_id = $request->input('sale_status_id');
            $sale->notes = $request->input('notes');
            $sale->payment_method= $request->input('payment_method');
            $sale->total_amount= 0.00;
            $sale->invoice_id = $request->input('invoice_id');
            $sale->receipt_id = $request->input(['receipt_id']);
            $sale->payment_date = $request->input('payment_date');
            $sale->amount_received = $request->input('amount_received');
            $sale->transport_value = $request->input('transport_value');
            $sale->other_expenses = $request->input('other_expenses');
            $sale->intermediary_committee = $request->input('intermediary_committee');

            $sale->save();

            $products = Product::pluck('name', 'id');
            return view('sales.choose_products', compact('sale', 'products'));
        } else if($request->has('form_products') || $request->has('edit') ){
            $sale_items = new SaleItem();
            $sale_items->sale_id = $request->input('sale_id');
            $sale_items->product_id = $request->input('product_id');
            $sale_items->quantity = $request->input('quantity');
            $sale_items->unit_price = $request->input('unit_price');
            $sale_items->sub_total = $sale_items->unit_price * $sale_items->quantity;
            $sale_items->save();

            $sale = Sale::where('id', $sale_items->sale_id)->first();
            $sale->total_amount=$sale->total_amount + $sale_items->sub_total;
            $products = Product::pluck('name', 'id');
            $sale->debt_amount = $sale->total_amount - $sale->receipt_id;

            flash('Produto Adicionado')->success();
            return view('sales.choose_products', compact('sale', 'products'));
        }
        flash('Erro')->error();
        return redirect()->route('sales.index');

    }


    public function show(Sale $sale)
    {

        $sale_items = SaleItem::with(['product'])->
        where('sale_id', $sale->id)->get();
        return view('sales.show', compact('sale', 'sale_items'));
    }


    public function edit(Sale $sale)
    {
        $sale_statuses = SaleStatus::pluck('name', 'id');
        $products = Product::pluck('name', 'id');
        return view('sales.edit', compact('sale', 'products', 'sale_statuses'));
    }


    public function update(SaleRequest $request, Sale $sale)
    {
        if($request->has(['addProduct'])){
            $products = Product::pluck('name', 'id');
            return view('sales.choose_products', compact('sale', 'products'));

        }

        if(($request->input('sale_status_id')) != null){
            $sale->sale_status_id = $request->input('sale_status_id');
        }

        if(($request->input('notes')) != null){
            $sale->notes = $request->input('notes');
        }
        if(( $request->input('payment_method')) != null){
            $sale->payment_method= $request->input('payment_method');
        }
        if(($request->input(['receipt_id'])) != null){
            $sale->receipt_id = $request->input(['receipt_id']);
        }
        if(($request->input('payment_date')) != null){
            $sale->payment_date = $request->input('payment_date');
        }
        if(($request->input('amount_received')) != null){
            $sale->amount_received = $request->input('amount_received');
        }
        if(($request->input('transport_value')) != null){
            $sale->transport_value = $request->input('transport_value');
        }
        if(($request->input('other_expenses')) != null){
            $sale->other_expenses = $request->input('other_expenses');
        }
        if(($request->input('intermediary_committee')) != null){
            $sale->intermediary_committee = $request->input('intermediary_committee');
        }




       # $sale->invoice_id = $request->input('invoice_id');






        $sale->total_amount =  $sale->transport_value + $sale->other_expenses +
            $sale->intermediary_committee;
        $sale->debt_amount = $sale->total_amount - $sale->receipt_id;
        $sale->save();
        return redirect()->route('sales.index');
    }


    public function destroy(string $id)
    {
        //
    }
}
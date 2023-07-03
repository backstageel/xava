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
use App\Http\Requests\SaleRequest;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use App\Models\Sale;

class SaleController extends Controller
{
    public function index()
    {


        $sales = Sale::with([ 'customer','saleItem.product', 'saleStatus'])
                    ->orderBy('id')->paginate(1000);

        $startDate = Date::now()->startOfYear();
        $endDate = Date::now()->endOfMonth();

        $sale_status = [
            'Draft' => Sale::where('sale_status_id', SaleStatus::where('name', 'draft')->value('id'))
                ->whereBetween('sale_date', [$startDate, $endDate])
                ->count(),
            'Facturado' => Sale::where('sale_status_id', SaleStatus::where('name', 'Facturado')->value('id'))
                ->whereBetween('sale_date', [$startDate, $endDate])
                ->count(),
            'Cotação' => Sale::where('sale_status_id', SaleStatus::where('name', 'Cotação')->value('id'))
                ->whereBetween('sale_date', [$startDate, $endDate])
                ->count(),
            'Pago' => Sale::where('sale_status_id', SaleStatus::where('name', 'Pago')->value('id'))
                ->whereBetween('sale_date', [$startDate, $endDate])
                ->count()
        ];

        #testes

        $sales_by_month1 = Sale::whereBetween('sale_date', [$startDate, $endDate])->selectRaw(
            'MONTHNAME(sale_date) as month, SUM(total_amount) as total, COUNT(*) as count'
        )->groupBy('month');

        $sales_by_month = [
            'Draft' => Sale::where('sale_status_id', SaleStatus::where('name', 'draft')->value('id'))
                ->whereBetween('sale_date', [$startDate, $endDate])->selectRaw(
                    'MONTHNAME(sale_date) as month, SUM(total_amount) as total, COUNT(*) as count'
                )->groupBy('month'),
            'Facturado' => Sale::where('sale_status_id', SaleStatus::where('name', 'Facturado')->value('id'))
                ->whereBetween('sale_date', [$startDate, $endDate])->selectRaw(
                    'MONTHNAME(sale_date) as month, SUM(total_amount) as total, COUNT(*) as count'
                )->groupBy('month'),
            'Cotação' => Sale::where('sale_status_id', SaleStatus::where('name', 'Cotação')->value('id'))
                ->whereBetween('sale_date', [$startDate, $endDate])->selectRaw(
                    'MONTHNAME(sale_date) as month, SUM(total_amount) as total, COUNT(*) as count'
                )->groupBy('month'),
            'Pago' => Sale::where('sale_status_id', SaleStatus::where('name', 'Pago')->value('id'))
                ->whereBetween('sale_date', [$startDate, $endDate])->selectRaw(
                    'MONTHNAME(sale_date) as month, SUM(total_amount) as total, COUNT(*) as count'
                )->groupBy('month')
        ];



        # vendas now
        $current_year_sales = Sale::whereBetween('sale_date', [$startDate, $endDate])->pluck('id');

        #valor de vendas por categoria
        $total_sales = Sale::whereBetween('sale_date', [$startDate, $endDate])->sum('total_amount');

        # id de produtos por categoria
        $computer_equipment_id = Product::where('category_id',
            ProductCategory::where('name', 'Equipamento electronico')->value('id'))->pluck('id');
        $bikes_id = Product::where('category_id',
            ProductCategory::where('name', 'Meios circulantes')->value('id'))->pluck('id');
        $others_id = Product::where('category_id',
            ProductCategory::where('name', 'outros')->value('id'))->pluck('id');


        $total_bikes = SaleItem::whereIn('sale_id', $current_year_sales)->whereIn('product_id', $bikes_id)->sum('sub_total');
        $total_computer_equipment = SaleItem::whereIn('sale_id', $current_year_sales)->whereIn('product_id', $computer_equipment_id)->sum('sub_total');
        $total_others = SaleItem::whereIn('sale_id', $current_year_sales)->whereIn('product_id', $others_id)->sum('sub_total');
        $total_paid = Sale::where('sale_status_id', SaleStatus::where('name', 'Pago')->value('id'))
            ->whereBetween('sale_date', [$startDate, $endDate])->sum('total_amount');

        $limit = 1000000.00;


        return view('sales.index', compact('sales',  'total_bikes', 'total_computer_equipment',
            'total_others', 'total_paid', 'sale_status',
        'total_sales', 'limit', 'sales_by_month', 'sales_by_month1'));
    }


    public function create()
    {
        #busca customerable_id da tabela customer para poder comparar com id das companias
        $customers_company = Customer::where('customerable_type', 'App\Models\Company')->get()->pluck('customerable_id');
        # busca todos nomes de companias que sejam clientes
        $company_names = Company::whereIn('id', $customers_company)->pluck('name');
        # busca id de clientes que pertencam
        $id_customer_company =DB::table('customers')->where('customerable_type', 'App\Models\Company')->get()->pluck('id');
        # combina o array de id de cliente co  o seu nome
        $company = array_combine( ($id_customer_company)->toArray(), $company_names->toArray());

        #busca customerable_id da tabela customer para poder comparar com id da tabela pessoa
        $customers_person =Customer::where('customerable_type', 'App\Models\Person')->get()->pluck('customerable_id');
        # busca id de clientes que pertencam
        $id_customer_person =DB::table('customers')->where('customerable_type', 'App\Models\Person')->get()->pluck('id');
        # busca todos nomes de pessoas que sejam clientes na tabela pessoa juntando first_name com last_name
        $person_names =DB::table('people')->whereIn('id', $customers_person)
           ->selectRaw("CONCAT(first_name, ' ', last_name) as full_name")->pluck('full_name');
        # combina o array de id de cliente co  o seu nome
        $person = array_combine( $id_customer_person->toArray(), $person_names->toArray());

        $customers = $person + $company;
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

            if(($request->input('amount_received')) != null){
                if(is_numeric( $request->input('amount_received'))) {
                    $sale->amount_received = $request->input('amount_received');
                }else{
                    flash('Formatação do campo "Valor Recebido" incorrecto.
                Separação de casas decimais para campos númericos: (0.0)')->error();
                    return redirect()->back()->withInput();
                }
            } else{
                $sale->amount_received = $request->input('amount_received');
            }

            if(($request->input('transport_value')) != null){
                if(is_numeric( $request->input('transport_value'))) {
                    $sale->transport_value = $request->input('transport_value');
                }else{
                flash('Formatação do campo "Valor do Transporte" incorrecto.
                Separação de casas decimais para campos númericos: (0.0)')->error();
                return redirect()->back()->withInput();
                }
            } else {
                    $sale->transport_value = $request->input('transport_value');
            }

            if(($request->input('other_expenses')) != null){
                if(is_numeric($request->input('other_expenses'))) {
                    $sale->other_expenses = $request->input('other_expenses');
                }else{
                    flash('Formatação do campo "Outras Despesas" incorrecto.
                Separação de casas decimais para campos númericos: 0.0')->error();
                    return redirect()->back()->withInput();
                }
            } else {
                $sale->other_expenses = $request->input('other_expenses');
            }

            if(($request->input('intermediary_committee')) != null){
                if(is_numeric( $request->input('intermediary_committee'))) {
                    $sale->intermediary_committee = $request->input('intermediary_committee');
                }else{
                    flash('Formatação do campo "Comissão de Intermediários" incorrecto.
                Separação de casas decimais para campos númericos: 0.0')->error();
                    return redirect()->back()->withInput();
                }
            } else {
                $sale->intermediary_committee = $request->input('intermediary_committee');
            }
            $sale->debt_amount = $sale->total_amount - $sale->amount_received;

            $sale->save();

            $products = Product::pluck('name', 'id');
            return view('sales.choose_products', compact('sale', 'products'));
        } else if($request->has('form_products') || $request->has('edit') ){
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

            $sale->save();

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
            if(is_numeric( $request->input('amount_received'))) {
                $sale->amount_received = $request->input('amount_received');
            }else{
                flash('Formatação do campo "Valor Recebido" incorrecto.
                Separação de casas decimais para campos númericos = (0.0)')->error();
                return redirect()->back()->withInput();
            }

        }
        if(($request->input('transport_value')) != null) {
            if (is_numeric($request->input('transport_value'))) {
                $sale->transport_value = $request->input('transport_value');
            } else {
                flash('Formatação do campo "Valor do Transporte" incorrecto.
                Separação de casas decimais para campos númericos = (0.0)')->error();
                return redirect()->back()->withInput();
            }
        }

        if(($request->input('other_expenses')) != null){
            if(is_numeric($request->input('other_expenses'))) {
                $sale->other_expenses = $request->input('other_expenses');
            }else{
                flash('Formatação do campo "Outras Despesas" incorrecto.
                Separação de casas decimais para campos númericos = (0.0)')->error();
                return redirect()->back()->withInput();
            }
        }
        if(($request->input('intermediary_committee')) != null){
            if(is_numeric( $request->input('intermediary_committee'))) {
                $sale->intermediary_committee = $request->input('intermediary_committee');
            }else{
                flash('Formatação do campo "Comissão de Intermediários" incorrecto.
                Separação de casas decimais para campos númericos = (0.0)')->error();
                return redirect()->back()->withInput();
            }


        }




       # $sale->invoice_id = $request->input('invoice_id');






        #$sale->total_amount =  $sale->transport_value + $sale->other_expenses + $sale->intermediary_committee;
        $sale->debt_amount = $sale->total_amount - $sale->receipt_id;
        $sale->save();
        if($request->has(['addProduct'])){

            $products = Product::pluck('name', 'id');
            return view('sales.choose_products', compact('sale', 'products'));

        }
        return redirect()->route('sales.index');
    }


    public function destroy(string $id)
    {
        //
    }
}

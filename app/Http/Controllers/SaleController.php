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

        #ano actual e mes actual
        $startDate = Date::now()->startOfYear();
        $endDate = Date::now()->endOfMonth();

        #Ano passado
        $now = Date::now();
        $lastYearStartDate = $now->modify('-1 year')->setDate($now->format('Y'), 1, 1)->setTime(0, 0, 0);
        $lastYearEndDate = clone $lastYearStartDate;
        $lastYearEndDate->modify('last day of December')->setTime(23, 59, 59);




        # meses que existam vendas
        $sales_by_month1 = Sale::whereBetween('sale_date', [$startDate, $endDate])->selectRaw(
            'MONTHNAME(sale_date) as month, SUM(total_amount) as total, COUNT(*) as count'
        )->groupBy('month');

        #  #Quantidade de vendas por estado, preco total por mes e por estado
        $sales_by_month = [
            'Draft' => Sale::where('sale_status_id', SaleStatus::where('name', 'Draft')->value('id'))
                ->whereBetween('sale_date', [$startDate, $endDate])->selectRaw(
                    'MONTHNAME(sale_date) as month, SUM(total_amount) as total, COUNT(*) as count'
                )->groupBy('month')->get(),
            'Facturado' => Sale::where('sale_status_id', SaleStatus::where('name', 'Facturado')->value('id'))
                ->whereBetween('sale_date', [$startDate, $endDate])->selectRaw(
                    'MONTHNAME(sale_date) as month, SUM(total_amount) as total, COUNT(*) as count'
                )->groupBy('month')->get(),
            'Cotacao' => Sale::where('sale_status_id', SaleStatus::where('name', 'Cotação')->value('id'))
                ->whereBetween('sale_date', [$startDate, $endDate])->selectRaw(
                    'MONTHNAME(sale_date) as month, SUM(total_amount) as total, COUNT(*) as count'
                )->groupBy('month')->get(),
            'Pago' => Sale::where('sale_status_id', SaleStatus::where('name', 'Pago')->value('id'))
                ->whereBetween('sale_date', [$startDate, $endDate])->selectRaw(
                    'MONTHNAME(sale_date) as month, SUM(total_amount) as total, COUNT(*) as count'
                )->groupBy('month')->get(),
            'month' => Sale::whereBetween('sale_date', [$startDate, $endDate])->selectRaw(
                'MONTHNAME(sale_date) as month, SUM(total_amount) as total, COUNT(*) as count'
            )->groupBy('month')->get()
        ];

        # id de produtos por categoria
        $computer_equipment_ids = Product::where('category_id',
            ProductCategory::where('name', 'Equipamento electrónico')->value('id'))->pluck('id');
        $rolling_stock_ids = Product::where('category_id',
            ProductCategory::where('name', 'Meios circulantes')->value('id'))->pluck('id');
        $others_ids = Product::where('category_id',
            ProductCategory::where('name', 'Outros')->value('id'))->pluck('id');

        # vendas Ano Corrente IT(Geral, Execução, Pago)
        $current_year_sales = Sale::whereBetween('sale_date', [$startDate, $endDate])->pluck('id');

        $computer_equipament_sales = SaleItem::whereIn('sale_id', $current_year_sales)
            ->whereIn('product_id', $computer_equipment_ids)->sum('sub_total');

        $on_going_computer_equipament_sales = SaleItem::whereIn('sale_id', $current_year_sales)
            ->whereIn('product_id', $computer_equipment_ids)->whereHas('sale', function ($query) {
                $query->where('sale_status_id', '!=', SaleStatus::where('name', 'Pago')->value('id'));
            })->sum('sub_total');

        $paid_computer_equipament_sales = SaleItem::whereIn('sale_id', $current_year_sales)
            ->whereIn('product_id', $computer_equipment_ids)->whereHas('sale', function ($query) {
                $query->where('sale_status_id',  SaleStatus::where('name', 'Pago')->value('id'));
            })->sum('sub_total');


        # vendas Ano Corrente Meios Circulantes(Geral, Execução, Pago)
        $rolling_stock_sales = SaleItem::whereIn('sale_id', $current_year_sales)
            ->whereIn('product_id', $rolling_stock_ids)->sum('sub_total');

        $on_going_rolling_stock_sales = SaleItem::whereIn('sale_id', $current_year_sales)
            ->whereIn('product_id', $rolling_stock_ids)->whereHas('sale', function ($query) {
                $query->where('sale_status_id', '!=', SaleStatus::where('name', 'Pago')->value('id'));
                })->sum('sub_total');

        $paid_rolling_stock_sales = SaleItem::whereIn('sale_id', $current_year_sales)
            ->whereIn('product_id', $rolling_stock_ids)->whereHas('sale', function ($query) {
                $query->where('sale_status_id',  SaleStatus::where('name', 'Pago')->value('id'));
            })->sum('sub_total');


        # vendas Ano Anterior IT(Geral, Execução, Pago)
        $last_year_sales = Sale::whereBetween('sale_date', [$lastYearStartDate, $lastYearEndDate])->pluck('id');

        $last_computer_equipament_sales = SaleItem::whereIn('sale_id', $last_year_sales)
            ->whereIn('product_id', $computer_equipment_ids)->sum('sub_total');

        $last_on_going_computer_equipament_sales = SaleItem::whereIn('sale_id', $last_year_sales)
            ->whereIn('product_id', $computer_equipment_ids)->whereHas('sale', function ($query) {
                    $query->where('sale_status_id', '!=', SaleStatus::where('name', 'Pago')->value('id'));
                })->sum('sub_total');

        $last_paid_computer_equipament_sales = SaleItem::whereIn('sale_id', $last_year_sales)
            ->whereIn('product_id', $computer_equipment_ids)->whereHas('sale', function ($query) {
                $query->where('sale_status_id', SaleStatus::where('name', 'Pago')->value('id'));
            })->sum('sub_total');


        # vendas Ano Anterior Meios Circulantes(Geral, Execução, Pago)
        $last_rolling_stock_sales = SaleItem::whereIn('sale_id', $last_year_sales)
            ->whereIn('product_id', $rolling_stock_ids)->sum('sub_total');

        $last_on_going_rolling_stock_sales = SaleItem::whereIn('sale_id', $last_year_sales)
            ->whereIn('product_id', $rolling_stock_ids)->whereHas('sale', function ($query) {
                $query->where('sale_status_id', '!=', SaleStatus::where('name', 'Pago')->value('id'));
            })->sum('sub_total');

        $last_paid_rolling_stock_sales = SaleItem::whereIn('sale_id', $last_year_sales)
            ->whereIn('product_id', $rolling_stock_ids)->whereHas('sale', function ($query) {
                $query->where('sale_status_id', SaleStatus::where('name', 'Pago')->value('id'));
            })->sum('sub_total');

        $computer_equipament_limit = 100000000.00;
        $rolling_stock_limit = 140000000.00;





        return view('sales.index', compact('sales',  'computer_equipament_sales', 'on_going_computer_equipament_sales',
        'paid_computer_equipament_sales', 'rolling_stock_sales', 'on_going_rolling_stock_sales', 'paid_rolling_stock_sales',
        'last_computer_equipament_sales', 'last_on_going_computer_equipament_sales', 'sales_by_month', 'sales_by_month1',
        'last_year_sales', 'last_paid_computer_equipament_sales', 'last_rolling_stock_sales', 'last_on_going_rolling_stock_sales',
        'last_paid_rolling_stock_sales', 'computer_equipament_limit', 'rolling_stock_limit'));
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

                $sale = new Sale();
                $sale->sale_ref = $request->input('sale_ref');
                $sale->customer_id = $request->input('customer_id');
                $customer = Customer::where('id', $sale->customer_id)->first();

                if ($customer->customerable_type == Company::class) {
                    $company = Company::where('id', $customer->customerable_id)->first();
                    $sale->customer_name = $company->name;
                } else {
                    $person = Person::where('id', $customer->customerable_id)->first();
                    $sale->customer_name = $person->first_name . $person->last_name;
                }

                $sale->sale_date = $request->input('sale_date');
                $sale->sale_status_id = $request->input('sale_status_id');
                $sale->notes = $request->input('notes');
                $sale->payment_method = $request->input('payment_method');
                $sale->total_amount = 0.00;
                $sale->invoice_id = $request->input('invoice_id');
                $sale->receipt_id = $request->input(['receipt_id']);
                $sale->payment_date = $request->input('payment_date');

                if (($request->input('amount_received')) != null) {
                    if (is_numeric($request->input('amount_received'))) {
                        $sale->amount_received = $request->input('amount_received');
                    } else {
                        flash('Formatação do campo "Valor Recebido" incorrecto.
                Separação de casas decimais para campos númericos: (0.0)')->error();
                        return redirect()->back()->withInput();
                    }
                } else {
                    $sale->amount_received = 0;
                }

                if (($request->input('transport_value')) != null) {
                    if (is_numeric($request->input('transport_value'))) {
                        $sale->transport_value = $request->input('transport_value');
                    } else {
                        flash('Formatação do campo "Valor do Transporte" incorrecto.
                Separação de casas decimais para campos númericos: (0.0)')->error();
                        return redirect()->back()->withInput();
                    }
                } else {
                    $sale->transport_value = 0;
                }

                if (($request->input('other_expenses')) != null) {
                    if (is_numeric($request->input('other_expenses'))) {
                        $sale->other_expenses = $request->input('other_expenses');
                    } else {
                        flash('Formatação do campo "Outras Despesas" incorrecto.
                Separação de casas decimais para campos númericos: 0.0')->error();
                        return redirect()->back()->withInput();
                    }
                } else {
                    $sale->other_expenses = 0;
                }

                if (($request->input('intermediary_committee')) != null) {
                    if (is_numeric($request->input('intermediary_committee'))) {
                        $sale->intermediary_committee = $request->input('intermediary_committee');
                    } else {
                        flash('Formatação do campo "Comissão de Intermediários" incorrecto.
                Separação de casas decimais para campos númericos: 0.0')->error();
                        return redirect()->back()->withInput();
                    }
                } else {
                    $sale->intermediary_committee = 0;
                }
                $sale->debt_amount = $sale->total_amount - $sale->amount_received;

                try {
                    $sale->save();

                    $products = Product::pluck('name', 'id');
                    return view('sale_items.create', compact('sale', 'products'));
                } catch (\Exception $exception) {
                    flash('Erro ao Adicionar Venda: ' . $exception->getMessage())->error();
                    return redirect()->back()->withInput();
                }




    }


    public function show(Sale $sale)
    {

        $sale_items = SaleItem::with(['product'])->
        where('sale_id', $sale->id)->get();
        return view('sales.show', compact('sale', 'sale_items'));
    }


    public function edit( Sale $sale)
    {

            $customers_company = Customer::where('customerable_type', 'App\Models\Company')->get()->pluck('customerable_id');
            $company_names = Company::whereIn('id', $customers_company)->pluck('name');
            $id_customer_company = DB::table('customers')->where('customerable_type', 'App\Models\Company')->get()->pluck('id');
            $company = array_combine(($id_customer_company)->toArray(), $company_names->toArray());
            $customers_person = Customer::where('customerable_type', 'App\Models\Person')->get()->pluck('customerable_id');
            $id_customer_person = DB::table('customers')->where('customerable_type', 'App\Models\Person')->get()->pluck('id');
            $person_names = DB::table('people')->whereIn('id', $customers_person)
                ->selectRaw("CONCAT(first_name, ' ', last_name) as full_name")->pluck('full_name');
            $person = array_combine($id_customer_person->toArray(), $person_names->toArray());

            $customers = $person + $company;
            $sale_statuses = SaleStatus::pluck('name', 'id');
            $products = Product::pluck('name', 'id');
            return view('sales.edit', compact('sale', 'products', 'customers', 'sale_statuses'));

    }


    public function update(SaleRequest $request, Sale $sale)
    {

        if($request->has('add_products')){
            $products = Product::pluck('name', 'id');
            return view('sale_items.create', compact('sale', 'products'));
        } else {
            $sale->customer_id = $request->input('customer_id');

            $customer = Customer::where('id', $sale->customer_id)->first();

            if ($customer->customerable_type == Company::class) {
                $company = Company::where('id', $customer->customerable_id)->first();
                $sale->customer_name = $company->name;
            } else {
                $person = Person::where('id', $customer->customerable_id)->first();
                $sale->customer_name = $person->first_name . $person->last_name;
            }

            if (($request->input('sale_ref')) != null) {
                $sale->sale_ref = $request->input(['sale_ref']);
            }
            if (($request->input('sale_date')) != null) {
                $sale->sale_date = $request->input('sale_date');
            }

            if (($request->input('invoice_id')) != null) {
                $sale->invoice_id = $request->input('invoice_id');
            }

            if (($request->input('sale_status_id')) != null) {
                $sale->sale_status_id = $request->input('sale_status_id');
            }

            if (($request->input('notes')) != null) {
                $sale->notes = $request->input('notes');
            }
            if (($request->input('payment_method')) != null) {
                $sale->payment_method = $request->input('payment_method');
            }
            if (($request->input(['receipt_id'])) != null) {
                $sale->receipt_id = $request->input(['receipt_id']);
            }
            if (($request->input('payment_date')) != null) {
                $sale->payment_date = $request->input('payment_date');
            }
            if (($request->input('amount_received')) != null) {
                if (is_numeric($request->input('amount_received'))) {
                    $sale->amount_received = $request->input('amount_received');
                } else {
                    flash('Formatação do campo "Valor Recebido" incorrecto.
                Separação de casas decimais para campos númericos = (0.0)')->error();
                    return redirect()->back()->withInput();
                }

            }
            if (($request->input('transport_value')) != null) {
                if (is_numeric($request->input('transport_value'))) {
                    $sale->transport_value = $request->input('transport_value');
                } else {
                    flash('Formatação do campo "Valor do Transporte" incorrecto.
                Separação de casas decimais para campos númericos = (0.0)')->error();
                    return redirect()->back()->withInput();
                }
            }

            if (($request->input('other_expenses')) != null) {
                if (is_numeric($request->input('other_expenses'))) {
                    $sale->other_expenses = $request->input('other_expenses');
                } else {
                    flash('Formatação do campo "Outras Despesas" incorrecto.
                Separação de casas decimais para campos númericos = (0.0)')->error();
                    return redirect()->back()->withInput();
                }
            }
            if (($request->input('intermediary_committee')) != null) {
                if (is_numeric($request->input('intermediary_committee'))) {
                    $sale->intermediary_committee = $request->input('intermediary_committee');
                } else {
                    flash('Formatação do campo "Comissão de Intermediários" incorrecto.
                Separação de casas decimais para campos númericos = (0.0)')->error();
                    return redirect()->back()->withInput();
                }


            }
            $sale->debt_amount = $sale->total_amount - $sale->amount_received;
            $sale->save();

            return redirect()->route('sales.index');
        }
    }


    public function destroy(string $id)
    {
        //
    }
}

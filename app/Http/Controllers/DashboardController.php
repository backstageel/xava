<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Customer;
use App\Models\CustomerInvoice;
use App\Models\Employee;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SaleStatus;
use Illuminate\Support\Facades\Date;

class DashboardController extends Controller
{
    public function index()
    {
        #ano actual e mes actual
        $startDate = Date::now()->startOfYear();
        $endDate = Date::now()->endOfMonth();

        #Ano passado
        $now = Date::now();
        $lastYearStartDate = $now->modify('-1 year')->setDate($now->format('Y'), 1, 1)->setTime(0, 0, 0);
        $lastYearEndDate = clone $lastYearStartDate;
        $lastYearEndDate->modify('last day of December')->setTime(23, 59, 59);

        $totalEmployees = Employee::count();
        $totalCustomers = Customer::count();


        $invoicesByMonth = CustomerInvoice::selectRaw(
            'MONTHNAME(invoice_date) as month, SUM(total_amount) as total,COUNT(*) as count'
        )
            ->whereBetween('invoice_date', [$startDate, $endDate])
            ->groupBy('month')
            ->get();

        $total_amount_sales =  Sale::whereBetween('sale_date', [$startDate, $endDate])->sum('total_amount');

        $mostSoldProducts = SaleItem::selectRaw(
            'products.name as product_name, sale_items.product_id, SUM(quantity) as total_quantity'
        )
            ->join('customer_invoices', 'customer_invoices.id', '=', 'sale_items.sale_id')
            ->join('products', 'products.id', '=', 'sale_items.product_id')
            ->whereBetween('customer_invoices.invoice_date', [$startDate, $endDate])
            ->groupBy('sale_items.product_id', 'product_name')
            ->orderByDesc('total_quantity')
            ->take(4) // only retrieve the top 10 products
            ->get();

        $lastSoldProducts = SaleItem::with(['sale.customer.customerable', 'sale.saleStatus', 'product'])
            ->join('customer_invoices', 'customer_invoices.id', '=', 'sale_items.sale_id')
            ->join('products', 'products.id', '=', 'sale_items.product_id')
            ->whereBetween('customer_invoices.invoice_date', [$startDate, $endDate])
            ->orderByDesc('customer_invoices.invoice_date')
            ->take(10) // retrieve the last 10 products
            ->get();

        //DashBoard Vendas
        $sales = Sale::with([ 'customer','saleItem.product', 'saleStatus'])
            ->orderBy('id')->paginate(1000);



        #Quantidade de vendas por estado, preco total por mes e por estado
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
            'Perdido' => Sale::where('sale_status_id', SaleStatus::where('name', 'Perdido')->value('id'))
                ->whereBetween('sale_date', [$startDate, $endDate])->selectRaw(
                    'MONTHNAME(sale_date) as month, SUM(total_amount) as total, COUNT(*) as count'
                )->groupBy('month')->get(),
            'month' => Sale::whereBetween('sale_date', [$startDate, $endDate])->selectRaw(
                'MONTHNAME(sale_date) as month, SUM(total_amount) as total, COUNT(*) as count'
            )->groupBy('month')->get()
        ];
# vendas Ano Corrente IT(Geral, Execução, Pago)
        $current_year_sales = Sale::whereBetween('sale_date', [$startDate, $endDate])->pluck('id');

        $computer_equipament_sales = Sale::whereIn('id', $current_year_sales)
            ->where('sale_status_id', '!=', [SaleStatus::where('name', 'Cotação')->value('id'),
                SaleStatus::where('name', 'Perdido')->value('id')])
            ->where('category_id', 11) //id = 11 => Equipamento electrónico
            ->sum('total_amount');

        $on_going_computer_equipament_sales = Sale::whereIn('id', $current_year_sales)
            ->whereIn('sale_status_id', [ SaleStatus::where('name', 'Facturado')->value('id'),
                SaleStatus::where('name', 'Pago')->value('id')])
            ->where('category_id', 11) //id = 11 => Equipamento electrónico
            ->sum('total_amount');

        $paid_computer_equipament_sales = Sale::whereIn('id', $current_year_sales)
            ->whereIn('sale_status_id', [ SaleStatus::where('name', 'Facturado')->value('id'),
                SaleStatus::where('name', 'Pago')->value('id')])
            ->where('category_id', 11) //id = 11 => Equipamento electrónico
            ->sum('amount_received');


        # vendas Ano Corrente Meios Circulantes(Geral, Execução, Pago)
        $rolling_stock_sales = Sale::whereIn('id', $current_year_sales)
            ->where('sale_status_id', '!=', [SaleStatus::where('name', 'Cotação')->value('id'),
                SaleStatus::where('name', 'Perdido')->value('id')])
            ->where('category_id', 3) //id = 3 => Meios circulantes
            ->sum('total_amount');

        $on_going_rolling_stock_sales = Sale::whereIn('id', $current_year_sales)
            ->whereIn('sale_status_id', [ SaleStatus::where('name', 'Facturado')->value('id'),
                SaleStatus::where('name', 'Pago')->value('id')])
            ->where('category_id', 3) //id = 3 => Meios circulantes
            ->sum('total_amount');

        $paid_rolling_stock_sales = Sale::whereIn('id', $current_year_sales)
            ->whereIn('sale_status_id',  [ SaleStatus::where('name', 'Facturado')->value('id'),
                SaleStatus::where('name', 'Pago')->value('id')])
            ->where('category_id', 3) //id = 3 => Meios circulantes
            ->sum('amount_received');


        # vendas Ano Anterior IT(Geral, Execução, Pago)
        $last_year_sales = Sale::whereBetween('sale_date', [$lastYearStartDate, $lastYearEndDate])->pluck('id');

        $last_computer_equipament_sales = Sale::whereIn('id', $last_year_sales)
            ->where('sale_status_id', '!=', [SaleStatus::where('name', 'Cotação')->value('id'),
                SaleStatus::where('name', 'Perdido')->value('id')])
            ->where('category_id', 11) //id = 11 => Equipamento electrónico
            ->sum('total_amount');

        $last_on_going_computer_equipament_sales = Sale::whereIn('id', $last_year_sales)
            ->whereIn('sale_status_id', [ SaleStatus::where('name', 'Facturado')->value('id'),
                SaleStatus::where('name', 'Pago')->value('id')])
            ->where('category_id', 11)
            ->sum('total_amount');

        $last_paid_computer_equipament_sales = Sale::whereIn('id', $last_year_sales)
            ->whereIn('sale_status_id', [ SaleStatus::where('name', 'Facturado')->value('id'),
                SaleStatus::where('name', 'Pago')->value('id')])
            ->where('category_id', 11)
            ->sum('amount_received');


        # vendas Ano Anterior Meios Circulantes(Geral, Execução, Pago)
        $last_rolling_stock_sales = Sale::whereIn('id', $last_year_sales)
            ->where('sale_status_id', '!=', [SaleStatus::where('name', 'Cotação')->value('id'),
                SaleStatus::where('name', 'Perdido')->value('id')])
            ->where('category_id', 3) //id = 3 => Meios circulantes
            ->sum('total_amount');


        $last_on_going_rolling_stock_sales = Sale::whereIn('id', $last_year_sales)
            ->whereIn('sale_status_id',  [ SaleStatus::where('name', 'Facturado')->value('id'),
                SaleStatus::where('name', 'Pago')->value('id')])
            ->where('category_id', 3) //id = 3 => Meios circulantes
            ->sum('total_amount');

        $last_paid_rolling_stock_sales = Sale::whereIn('id', $last_year_sales)
            ->whereIn('sale_status_id',  [ SaleStatus::where('name', 'Facturado')->value('id'),
                SaleStatus::where('name', 'Pago')->value('id')])
            ->where('category_id', 3)
            ->sum('amount_received');

        $profit_rolling_stock_sales  = Sale::whereIn('id', $current_year_sales)
            ->where('category_id', 3) //id = 3 => Meios circulantes
            ->sum('profit');

        $profit_computer_equipament_sales = Sale::whereIn('id', $current_year_sales)
            ->where('category_id', 11) //id = 11 => Equipamento electrónico
            ->sum('profit');

        $computer_equipament_limit = 100000000.00;
        $rolling_stock_limit = 140000000.00;

        //concursos
        $total_competitions = Competition::count();




        return view('dashboard', compact(
                'totalEmployees','totalCustomers', 'invoicesByMonth', 'mostSoldProducts', 'lastSoldProducts',
                    'profit_computer_equipament_sales', 'profit_rolling_stock_sales', 'sales',  'computer_equipament_sales', 'on_going_computer_equipament_sales',
                    'paid_computer_equipament_sales', 'rolling_stock_sales', 'on_going_rolling_stock_sales', 'paid_rolling_stock_sales',
                    'last_computer_equipament_sales', 'last_on_going_computer_equipament_sales', 'sales_by_month', 'total_amount_sales',
                    'last_year_sales', 'last_paid_computer_equipament_sales', 'last_rolling_stock_sales', 'last_on_going_rolling_stock_sales',
                    'last_paid_rolling_stock_sales', 'computer_equipament_limit', 'rolling_stock_limit', 'total_competitions'
            )
        );
    }
}

<?php

    namespace App\Http\Controllers;

    use App\Models\Customer;
    use App\Models\CustomerInvoice;
    use App\Models\CustomerInvoiceItem;
    use App\Models\Employee;
    use App\Models\SaleItem;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Date;

    class DashboardController extends Controller
    {
        public function index()
        {
            $startDate = Date::now()->startOfYear();
            $endDate = Date::now()->endOfMonth();

            $totalEmployees = Employee::count();
            $totalCustomers = Customer::count();
            $totalInvoices = CustomerInvoice::whereBetween('invoice_date', [$startDate, $endDate])->count();
            $totalInvoicesAmount = CustomerInvoice::whereBetween('invoice_date', [$startDate, $endDate])->sum('total_amount');

            $invoicesByMonth = CustomerInvoice::selectRaw('MONTHNAME(invoice_date) as month, SUM(total_amount) as total,COUNT(*) as count')
                ->whereBetween('invoice_date', [$startDate, $endDate])
                ->groupBy('month')
                ->get();

            $mostSoldProducts = SaleItem::selectRaw('products.name as product_name, sale_items.product_id, SUM(quantity) as total_quantity')
                ->join('customer_invoices', 'customer_invoices.id', '=', 'sale_items.sale_id')
                ->join('products', 'products.id', '=', 'sale_items.product_id')
                ->whereBetween('customer_invoices.invoice_date', [$startDate, $endDate])
                ->groupBy('sale_items.product_id', 'product_name')
                ->orderByDesc('total_quantity')
                ->take(4) // only retrieve the top 10 products
                ->get();

            $lastSoldProducts = SaleItem::with(['sale.customer.customerable','sale.saleStatus','product'])
                ->join('customer_invoices', 'customer_invoices.id', '=', 'sale_items.sale_id')
                ->join('products', 'products.id', '=', 'sale_items.product_id')
                ->whereBetween('customer_invoices.invoice_date', [$startDate, $endDate])
                ->orderByDesc('customer_invoices.invoice_date')
                ->take(10) // retrieve the last 10 products
                ->get();


            return view('dashboard',
                compact('totalEmployees', 'totalCustomers', 'totalInvoices', 'totalInvoicesAmount', 'invoicesByMonth',
                    'mostSoldProducts','lastSoldProducts'));
        }
    }

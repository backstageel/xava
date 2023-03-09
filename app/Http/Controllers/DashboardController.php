<?php

    namespace App\Http\Controllers;

    use App\Models\Customer;
    use App\Models\CustomerInvoice;
    use App\Models\CustomerInvoiceItem;
    use App\Models\Employee;
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

            $mostSoldProducts = CustomerInvoiceItem::selectRaw('products.name as product_name, customer_invoice_items.product_id, SUM(quantity) as total_quantity')
                ->join('customer_invoices', 'customer_invoices.id', '=', 'customer_invoice_items.invoice_id')
                ->join('products', 'products.id', '=', 'customer_invoice_items.product_id')
                ->whereBetween('customer_invoices.invoice_date', [$startDate, $endDate])
                ->groupBy('customer_invoice_items.product_id', 'product_name')
                ->orderByDesc('total_quantity')
                ->take(4) // only retrieve the top 10 products
                ->get();

            $lastSoldProducts = CustomerInvoiceItem::with(['invoice','product'])
                ->join('customer_invoices', 'customer_invoices.id', '=', 'customer_invoice_items.invoice_id')
                ->join('products', 'products.id', '=', 'customer_invoice_items.product_id')
                ->whereBetween('customer_invoices.invoice_date', [$startDate, $endDate])
                ->orderByDesc('customer_invoices.invoice_date')
                ->take(10) // retrieve the last 10 products
                ->get();
            return view('dashboard',
                compact('totalEmployees', 'totalCustomers', 'totalInvoices', 'totalInvoicesAmount', 'invoicesByMonth',
                    'mostSoldProducts','lastSoldProducts'));
        }
    }

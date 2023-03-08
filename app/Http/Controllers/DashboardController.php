<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerInvoice;
use App\Models\Employee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $totalEmployees = Employee::count();
        $totalCustomers = Customer::count();
        $totalInvoices = CustomerInvoice::count();
        return view('dashboard',compact('totalEmployees','totalCustomers','totalInvoices'));
    }
}

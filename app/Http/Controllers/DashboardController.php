<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $totalEmployees = Employee::count();
        return view('dashboard',compact('totalEmployees'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoanController;
use App\Models\Employee;
use App\Models\Loan;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use PDF;


class CreatePdfController extends Controller
{
    public function index(){

    }
    public function store(Request $request)
    {
        $amount = $request->input('amount');
        $installment = $request->input('installment');
        $months = $request->input('months');
        $full_name = $request->input('full_name');
        $employee_position = $request->input('employee_position');


        $html = view('loans.application', compact('amount', 'installment',
        'months', 'full_name', 'employee_position'))->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        return $dompdf->stream('pedido.pdf');
    }
    public function create()
    {
        return view('loans.form');
    }



    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}


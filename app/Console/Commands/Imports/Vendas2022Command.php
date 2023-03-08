<?php

namespace App\Console\Commands\Imports;

use App\Imports\Vendas2022Import;
use App\Models\CustomerInvoice;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class Vendas2022Command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:vendas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Excel::import(new Vendas2022Import(), 'vendas2022.xlsx');

        $this->updateInvoiceTable();

        return true;
    }

    private function updateInvoiceTable()
    {
        $invoices = CustomerInvoice::with('invoiceItems')->get();
        foreach ($invoices as $invoice){
            $totalAmount = $invoice->invoiceItems->sum('sub_total');
            $invoice->total_amount = $totalAmount;
            $invoice->save();
        }
    }
}

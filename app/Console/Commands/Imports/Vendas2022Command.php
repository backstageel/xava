<?php

namespace App\Console\Commands\Imports;

use App\Imports\Vendas2022Import;
use App\Models\CustomerInvoice;
use App\Models\Sale;
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
        Excel::import(new Vendas2022Import(2022), 'vendas2022.xlsx');
        Excel::import(new Vendas2022Import(2023), 'vendas2023.xlsx');

        $this->updateInvoiceTable();

        return true;
    }

    private function updateInvoiceTable()
    {
        $sales = Sale::with('saleItems')->get();
        foreach ($sales as $sale){
            $totalAmount = $sale->saleItems->sum('sub_total');
            $sale->total_amount = $totalAmount;
            $sale->save();

            $invoice = CustomerInvoice::where('sale_id',$sale->id)->first();
            $invoice->total_amount = $totalAmount;
            $invoice->save();
        }
    }
}

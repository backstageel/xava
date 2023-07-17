<?php

namespace App\Exports;

use App\Models\Sale;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SaleExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        return view('exports.sales', [
            'sales' =>  Sale::with([ 'customer','saleItem.product', 'saleStatus'])
                ->orderBy('id')->paginate(1000)
        ]);
    }
}

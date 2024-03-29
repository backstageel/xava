<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;

class ProductExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {

        return view('exports.product', [
            'products' =>  Product::with([ 'ProductCategory'])
                ->orderBy('id')->paginate(1000)
        ]);

    }
}

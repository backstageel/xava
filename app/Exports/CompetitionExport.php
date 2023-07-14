<?php

namespace App\Exports;

use App\Models\Competition;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CompetitionExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.competitions', [
            'competitions' => Competition::with(
                [
                    'customer.customerable',
                    'ProductCategory',
                    'competitionType',
                    'competitionReason',
                    'competitionStatus',
                    'product.productCategory',
                    'companyType',
                    'competitionResult',
                    'ProductCategory.productsubcategories'

                ]
            )->orderBy('id')->paginate(1000)
        ]);
    }
}

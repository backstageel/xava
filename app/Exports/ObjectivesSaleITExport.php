<?php

namespace App\Exports;

use App\Models\Sale;
use App\Models\SaleStatus;
use Illuminate\Support\Facades\Date;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ObjectivesSaleITExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $startDate = Date::now()->startOfYear();
        $endDate = Date::now()->endOfMonth();


        $current_year_sales = Sale::whereBetween('sale_date', [$startDate, $endDate])->pluck('id');
        $computer_equipament_sales = Sale::whereIn('id', $current_year_sales)
            ->where('sale_status_id', '!=', SaleStatus::where('name', 'Cotação')->value('id'))
            ->where('category_id', 11) //id = 11 => Equipamento electrónico
            ->sum('total_amount');

        $on_going_computer_equipament_sales = Sale::whereIn('id', $current_year_sales)
            ->whereIn('sale_status_id', [ SaleStatus::where('name', 'Facturado')->value('id'),
                SaleStatus::where('name', 'Pago')->value('id')])
            ->where('category_id', 11) //id = 11 => Equipamento electrónico
            ->sum('total_amount');

        $paid_computer_equipament_sales = Sale::whereIn('id', $current_year_sales)
            ->whereIn('sale_status_id', [ SaleStatus::where('name', 'Facturado')->value('id'),
                SaleStatus::where('name', 'Pago')->value('id')])
            ->where('category_id', 11) //id = 11 => Equipamento electrónico
            ->sum('amount_received');
        $computer_equipament_limit = 100000000.00;

        $sales =  Sale::with([ 'customer','saleItem.product', 'saleStatus'])
            ->where('category_id', 11)//Equipamento Electrónico
            ->orderBy('id')->paginate(1000);

        return view('exports.sale_objectivesIT', ['sales'=>$sales,
            'computer_equipament_sales' => $computer_equipament_sales,
            'on_going_computer_equipament_sales' => $on_going_computer_equipament_sales,
            'paid_computer_equipament_sales'=>$paid_computer_equipament_sales,
            'limit' => $computer_equipament_limit
        ]);

    }
}

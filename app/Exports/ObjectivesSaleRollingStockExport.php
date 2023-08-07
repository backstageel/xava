<?php

namespace App\Exports;

use App\Models\Sale;
use App\Models\SaleStatus;
use Illuminate\Support\Facades\Date;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;


class ObjectivesSaleRollingStockExport  implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $startDate = Date::now()->startOfYear();
        $endDate = Date::now()->endOfMonth();


        $current_year_sales = Sale::whereBetween('sale_date', [$startDate, $endDate])->pluck('id');
        $rolling_stock_sales = Sale::whereIn('id', $current_year_sales)
            ->where('sale_status_id', '!=', SaleStatus::where('name', 'Cotação')->value('id'))
            ->where('category_id', 3) //id = 3 => Meios circulantes
            ->sum('total_amount');

        $on_going_rolling_stock_sales = Sale::whereIn('id', $current_year_sales)
            ->whereIn('sale_status_id', [SaleStatus::where('name', 'Facturado')->value('id'),
                SaleStatus::where('name', 'Pago')->value('id')])
            ->where('category_id', 3) //id = 3 => Meios circulantes
            ->sum('total_amount');

        $paid_rolling_stock_sales = Sale::whereIn('id', $current_year_sales)
            ->whereIn('sale_status_id', [SaleStatus::where('name', 'Facturado')->value('id'),
                SaleStatus::where('name', 'Pago')->value('id')])
            ->where('category_id', 3) //id = 3 => Meios circulantes
            ->sum('amount_received');
        $rolling_stock_limit = 140000000.00;

        $sales = Sale::with(['customer', 'saleItem.product', 'saleStatus'])
            ->where('category_id', 3)//meios circulantes
            ->orderBy('id')->paginate(1000);

        return view('exports.sale_objectivesRollingStock', ['sales' => $sales,
            'rolling_stock_sales' => $rolling_stock_sales,
            'on_going_rolling_stock_sales' => $on_going_rolling_stock_sales,
            'paid_rolling_stock_sales' => $paid_rolling_stock_sales,
            'limit' => $rolling_stock_limit
        ]);
    }
}

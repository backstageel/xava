<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class Vendas2022Import implements OnEachRow,WithHeadingRow,WithCalculatedFormulas
{

    public function onRow(Row $row)
    {
        $row = $row->toArray();
        $clientName = trim($row['cliente']);
        dump($clientName);
        dd($row);
        return false;
    }
}

<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\Customer;
use App\Models\CustomerInvoice;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class Vendas2022Import implements OnEachRow, WithHeadingRow, WithCalculatedFormulas
{

    private mixed $year;

    public function __construct($year)
    {
        $this->year = $year;
    }

    public function onRow(Row $row)
    {

        $rowIndex = $row->getIndex();
        $row = $row->toArray(null, true);
        $clientName = trim($row['cliente'] ?? '');
        $clientName = $clientName === '' ? null : $clientName;
        if ($clientName === null) {
            return;
            dd($rowIndex, $row);
        }
        if ($row['factura'] == null) {
            return;
        }
        $company = Company::firstOrCreate(['name' => $clientName]);
        $customer = Customer::firstOrCreate([
            'customerable_type' => Company::class,
            'customerable_id' => $company->id,
        ]);

        $mes = $row['mes'];
        $invoiceDate = null;
        switch ($mes) {
            case 'Janeiro':
                $invoiceDate = Date::parse('first day of January ' . $this->year);
                break;
            case 'Fevereiro':
                $invoiceDate = Date::parse('first day of February ' . $this->year);
                break;
            case 'Março':
                $invoiceDate = Date::parse('first day of March ' . $this->year);
                break;
            case 'Abril':
                $invoiceDate = Date::parse('first day of April ' . $this->year);
                break;
            case 'Maio':
                $invoiceDate = Date::parse('first day of May ' . $this->year);
                break;
            case 'Junho':
                $invoiceDate = Date::parse('first day of June ' . $this->year);
                break;
            case 'Julho':
                $invoiceDate = Date::parse('first day of July ' . $this->year);
                break;
            case 'Agosto':
                $invoiceDate = Date::parse('first day of August ' . $this->year);
                break;
            case 'Setembro':
                $invoiceDate = Date::parse('first day of September ' . $this->year);
                break;
            case 'Outubro':
                $invoiceDate = Date::parse('first day of October ' . $this->year);
                break;
            case 'Novembro':
                $invoiceDate = Date::parse('first day of November ' . $this->year);
                break;
            case 'Dezembro':
                $invoiceDate = Date::parse('first day of December ' . $this->year);
                break;
            default:
                $invoiceDate = Date::parse('first day of December ' . $this->year);
        }

        $sale = Sale::firstOrCreate([
            'customer_id' => $customer->id,
            'sale_ref' => $row['factura'],
            'sale_date' => $invoiceDate,
            'customer_name'=>$customer->customerable->name
        ]);

        $invoice = CustomerInvoice::firstOrCreate([
            'customer_id' => $customer->id,
            'sale_id' => $sale->id,
            'invoice_number' => $row['factura'],
            'invoice_date' => $invoiceDate,
        ]);
        $product = Product::firstOrCreate([
            'name' => $row['descricao_duto'],
        ], ['sale_price' => $row['preco_venda'],],
            ['purchase_price' => $row['PRECO_DE_COMPRA'],]
        );
        $invoiceItem = SaleItem::firstOrCreate([
            'sale_id' => $invoice->id,
            'product_id' => $product->id,
            'quantity' => $row['qty'],
            'unit_price' => $row['preco_venda'],
            'sub_total' => $row['valor_venda'] ?? $row['qty'] * $row['preco_venda'],
        ]);
        dump($rowIndex);
        //dd($invoice);
    }
}

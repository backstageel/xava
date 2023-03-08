<?php

    namespace App\Imports;

    use App\Models\Company;
    use App\Models\Customer;
    use App\Models\CustomerInvoice;
    use App\Models\CustomerInvoiceItem;
    use App\Models\Product;
    use Illuminate\Support\Collection;
    use Illuminate\Support\Facades\Date;
    use Maatwebsite\Excel\Concerns\OnEachRow;
    use Maatwebsite\Excel\Concerns\ToCollection;
    use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
    use Maatwebsite\Excel\Concerns\WithHeadingRow;
    use Maatwebsite\Excel\Row;

    class Vendas2022Import implements OnEachRow, WithHeadingRow, WithCalculatedFormulas
    {

        public function onRow(Row $row)
        {

            $rowIndex = $row->getIndex();
            $row = $row->toArray(null, true);
            $clientName = trim($row['cliente']);
            $clientName = $clientName === '' ? null : $clientName;
            if ($clientName === null) {
                return ;
                dd($rowIndex, $row);
            }
            if($row['factura']==null){
                return ;
            }
            $company = Company::firstOrCreate(['name' => $clientName]);
            $customer = Customer::firstOrCreate([
                'customable_type' => Company::class,
                'customable_id' => $company->id,
            ]);

            $mes = $row['mes'];
            $invoiceDate = null;
            switch ($mes) {
                case 'Janeiro':
                    $invoiceDate = Date::parse('first day of January 2022');
                    break;
                case 'Janeiro':
                    $invoiceDate = Date::parse('first day of January 2022');
                    break;
                case 'Fevereiro':
                    $invoiceDate = Date::parse('first day of February 2022');
                    break;
                case 'Março':
                    $invoiceDate = Date::parse('first day of March 2022');
                    break;
                case 'Abril':
                    $invoiceDate = Date::parse('first day of April 2022');
                    break;
                case 'Maio':
                    $invoiceDate = Date::parse('first day of May 2022');
                    break;
                case 'Junho':
                    $invoiceDate = Date::parse('first day of June 2022');
                    break;
                case 'Julho':
                    $invoiceDate = Date::parse('first day of July 2022');
                    break;
                case 'Agosto':
                    $invoiceDate = Date::parse('first day of August 2022');
                    break;
                case 'Setembro':
                    $invoiceDate = Date::parse('first day of September 2022');
                    break;
                case 'Outubro':
                    $invoiceDate = Date::parse('first day of October 2022');
                    break;
                case 'Novembro':
                    $invoiceDate = Date::parse('first day of November 2022');
                    break;
                case 'Dezembro':
                    $invoiceDate = Date::parse('first day of December 2022');
                    break;
                default:
                    $invoiceDate = Date::parse('first day of December 2022');
            }
            $invoice = CustomerInvoice::firstOrCreate([
                'customer_id' => $customer->id,
                'invoice_number' => $row['factura'],
                'invoice_date' => $invoiceDate,
            ]);
            $product = Product::firstOrCreate([
                'name' => $row['descricao_duto'],
            ], ['sale_price' => $row['preco_venda'],]
            );
            $invoiceItem = CustomerInvoiceItem::firstOrCreate([
                'invoice_id' => $invoice->id,
                'product_id' => $product->id,
                'quantity' => $row['qty'],
                'unit_price' => $row['preco_venda'],
                'sub_total' => $row['valor_venda']?? $row['qty']*$row['preco_venda'],
            ]);
            dump($rowIndex);
            //dd($invoice);
        }
    }

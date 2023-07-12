<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\Competition;
use App\Models\CompetitionReason;
use App\Models\CompetitionStatus;
use App\Models\CompetitionType;
use App\Models\Customer;
use App\Models\CustomerInvoice;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class ConcursosImport implements OnEachRow, WithHeadingRow, WithCalculatedFormulas
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
        $clientName = trim($row['instituicao'] ?? '');
        $clientName = $clientName === '' ? null : $clientName;
        if ($clientName === null) {
            dd($rowIndex, $row);
            return;

        }
        $company = Company::firstOrCreate(['name' => $clientName]);
        $customer = Customer::firstOrCreate([
            'customerable_type' => Company::class,
            'customerable_id' => $company->id,
        ]);

        $competitionType = CompetitionType::firstOrCreate([
            'name' => $row['tipo_de_concurso'],
        ]);

        $competitionNumber = $row['numero_do_concurso'];
        $productCategory = ProductCategory::firstOrCreate([
            'name' => $row['naturezaindustria_do_concurso']??'Diversos',
        ]);
        $product = Product::firstOrCreate([
            'name' => $row['tipos_de_produtos']??'Não Definido',
            'category_id' => $productCategory->id,
        ]);

        $garantiaProvisiora = $row['garantia_bancaria_provisoria'];
        $premio = $row['premio'];
        $garantiaDefinitiva = $row['garantia_definitiva'];
        $premio2 = $row['premio2'];
        $garantiaAdiantamento = $row['garantia_de_adiantamento'];
        $premio3 = $row['premio3'];

        $proposalDate = Date::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['data_entrega_propostas']));
        $proposalTime = Date::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['hora_de_entrega']));
        $proposalDate = $proposalDate->addHours($proposalTime->format('H'))->addMinutes($proposalTime->format('i'));

        $valorCadernoEncargos = $row['valor_cadernoenc'];

        $competitionReason = CompetitionReason::firstOrCreate([
            'name' => $row['motivo']??'Não definido',
        ]);
        $competitionStatus = CompetitionStatus::firstOrCreate([
            'name' => $row['por_fazer']??'Não definido',
        ]);

        $proposalValue = $row['valor_da_proposta'];
        $responsible = $row['responsavel'];
        $revisaoTecnica = $row['revisao_da_proposta_tecnica'];
        $revisaoDocumental = $row['revisao_documental'];

        $competition = Competition::firstOrCreate(['competition_reference'=>$competitionNumber],[
            'competition_month'=>$row['mes'],
            'internal_reference'=>$row['no_do_concurso_xava'],
            'competition_type_id' => $competitionType->id,
            'competition_reference'=>$competitionNumber,
            'customer_id'=>$customer->id,
            'product_id'=>$product->id,
            'product_category_id'=>$productCategory->id,
            'provisional_bank_guarantee'=>$garantiaProvisiora,
            'provisional_bank_guarantee_award'=>$premio,
            'definitive_guarantee'=>$garantiaDefinitiva,
            'definitive_guarantee_award'=>$premio2,
            'advance_guarantee'=>$garantiaAdiantamento,
            'advance_guarantee_award'=>$premio3,
            'proposal_delivery_date'=>$proposalDate,
            'proposal_value'=>$proposalValue,
            'technical_proposal_review'=>$revisaoTecnica,
            'documentary_review'=>$revisaoDocumental,
            'competition_reason_id'=>$competitionReason->id,
            'competition_status_id'=>$competitionStatus->id,
            'responsible'=>$responsible,
            'bidding_documents_value'=>$valorCadernoEncargos,

        ]);

        dump($rowIndex);
        //dd($invoice);
    }

    /**
     * @param mixed $mes
     * @return \Illuminate\Support\Carbon
     */
    public function getDateByMonth(mixed $mes): \Illuminate\Support\Carbon
    {
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
        return $invoiceDate;
    }
}

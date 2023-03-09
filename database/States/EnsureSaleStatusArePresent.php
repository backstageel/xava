<?php

    namespace Database\States;

    use Illuminate\Support\Facades\DB;

    class EnsureSaleStatusArePresent
    {
        public function __invoke()
        {
            if ($this->present()) {
                return;
            }
            $saleStatuses = [
                ['name' => 'Draft'],
                ['name' => 'Cotação'],
                ['name' => 'Facturado'],
                ['name' => 'Pago']
            ];

            DB::table('sale_statuses')->insert($saleStatuses);
        }

        public function present()
        {
            return DB::table('sale_statuses')->count() > 0;
        }
    }

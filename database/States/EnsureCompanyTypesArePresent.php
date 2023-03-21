<?php

namespace Database\States;

use Illuminate\Support\Facades\DB;

class EnsureCompanyTypesArePresent
{
    public function __invoke()
    {
        if ($this->present()) {
            return;
        }
        $companyTypes = [
            ['name' => 'Sociedade por Quotas'],
            ['name' => 'SARL'],
            ['name' => 'Particular'],
            ['name' => 'Pública'],
        ];

        DB::table('company_types')->insert($companyTypes);
    }

    public function present()
    {
        return DB::table('company_types')->count() > 0;
    }
}

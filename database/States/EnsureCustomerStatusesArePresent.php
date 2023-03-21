<?php

namespace Database\States;

use Illuminate\Support\Facades\DB;

class EnsureCustomerStatusesArePresent
{
    public function __invoke()
    {
        if ($this->present()) {
            return;
        }
        $customerStatuses = [
            ['name' => 'Activo'],
            ['name' => 'Inactivo'],
            ['name' => 'Banido']
        ];

        DB::table('customer_statuses')->insert($customerStatuses);
    }

    public function present()
    {
        return DB::table('customer_statuses')->count() > 0;
    }
}

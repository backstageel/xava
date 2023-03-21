<?php

namespace Database\States;

use Illuminate\Support\Facades\DB;

class EnsurePartnershipTypesArePresent
{
    public function __invoke()
    {
        if ($this->present()) {
            return;
        }
        DB::table('partnership_types')->insert([
            ['name' => 'Personalidade'],
            ['name' => 'Empresa'],
        ]);
    }

    public function present()
    {
        return DB::table('partnership_types')->count() > 0;
    }
}

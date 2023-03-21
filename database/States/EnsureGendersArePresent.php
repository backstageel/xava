<?php

namespace Database\States;

use Illuminate\Support\Facades\DB;

class EnsureGendersArePresent
{
    public function __invoke()
    {
        if ($this->present()) {
            return;
        }
        $companyTypes = [
            ['name' => 'Masculino'],
            ['name' => 'Feminino'],
        ];

        DB::table('genders')->insert($companyTypes);
    }

    public function present()
    {
        return DB::table('genders')->count() > 0;
    }
}

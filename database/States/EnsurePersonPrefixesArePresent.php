<?php

namespace Database\States;

use Illuminate\Support\Facades\DB;

class EnsurePersonPrefixesArePresent
{
    public function __invoke()
    {
        if ($this->present()) {
            return;
        }
        $civilStates = [
            ['name' => 'Técnico', 'code' => 'Tec.'],
            ['name' => 'Bacharel', 'code' => 'Bach.'],
            ['name' => 'Licenciado', 'code' => 'Lic.'],
            ['name' => 'Engenheiro', 'code' => 'Eng.'],
            ['name' => 'Mestrado', 'code' => 'Msc'],
            ['name' => 'Doutorado', 'code' => 'Dr.'],
            ['name' => 'Especialista', 'code' => 'Esp'],
        ];

        DB::table('person_prefixes')->insert($civilStates);
    }

    public function present()
    {
        return DB::table('person_prefixes')->count() > 0;
    }
}

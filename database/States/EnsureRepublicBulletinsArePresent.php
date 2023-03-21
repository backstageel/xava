<?php

namespace Database\States;

use Illuminate\Support\Facades\DB;

class EnsureRepublicBulletinsArePresent
{
    public function __invoke()
    {
        if ($this->present()) {
            return;
        }
        $republicBulletins = [
            [
                'name' => 'BR_0_0_SERIE_2000',
                'date_publication' => '1975-06-25',
                'serie_number' => '0',
                'publication_number' => 0,
                'publication_year' => 1975
            ],
            [
                'name' => 'BR_207_III_SERIE_2019',
                'date_publication' => '2019-10-28',
                'serie_number' => 'III',
                'publication_number' => 207,
                'publication_year' => 2019
            ],
        ];

        DB::table('republic_bulletins')->insert($republicBulletins);
    }

    public function present()
    {
        return DB::table('republic_bulletins')->count() > 0;
    }
}

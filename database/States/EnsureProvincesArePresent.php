<?php

namespace Database\States;

use App\Models\Country;
use Illuminate\Support\Facades\DB;

class EnsureProvincesArePresent
{
    public function __invoke()
    {
        if ($this->present()) {
            return;
        }

        $country = Country::where('code', 'MZ')->first();


        $provinces = [
            [
                'code' => '09',
                'name' => 'Cabo Delgado',
                'country_id' => $country->id,
            ],
            [
                'code' => '02',
                'name' => 'Gaza',
                'country_id' => $country->id,
            ],
            [
                'code' => '03',
                'name' => 'Inhambane',
                'country_id' => $country->id,
            ],
            [
                'code' => '05',
                'name' => 'Manica',
                'country_id' => $country->id,
            ],
            [
                'code' => '12',
                'name' => 'Cidade de Maputo',
                'country_id' => $country->id,
            ],
            [
                'code' => '01',
                'name' => 'Maputo',
                'country_id' => $country->id,
            ],
            [
                'code' => '08',
                'name' => 'Nampula',
                'country_id' => $country->id,
            ],
            [
                'code' => '10',
                'name' => 'Niassa',
                'country_id' => $country->id,
            ],
            [
                'code' => '04',
                'name' => 'Sofala',
                'country_id' => $country->id,
            ],
            [
                'code' => '06',
                'name' => 'Tete',
                'country_id' => $country->id,
            ],
            [
                'code' => '07',
                'name' => 'Zambézia',
                'country_id' => $country->id,
            ],
            [
                'code' => '00',
                'name' => 'Desconhecido',
                'country_id' => $country->id,
            ],
            [
                'code' => '11',
                'name' => 'Estrangeiro',
                'country_id' => '1',
            ],
        ];

        DB::table('provinces')->insert($provinces);
    }

    public function present()
    {
        return DB::table('provinces')->count() > 0;
    }
}

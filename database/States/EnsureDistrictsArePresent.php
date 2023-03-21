<?php

namespace Database\States;

use App\Models\Country;
use App\Models\Province;
use Illuminate\Support\Facades\DB;

class EnsureDistrictsArePresent
{
    public function __invoke()
    {
        if ($this->present()) {
            return;
        }

        $districts = [
            ['code' => null, 'name' => 'Cidade de Pemba', 'province' => 'Cabo Delgado', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Ancuabe', 'province' => 'Cabo Delgado', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Balama', 'province' => 'Cabo Delgado', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Chiure', 'province' => 'Cabo Delgado', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Ibo', 'province' => 'Cabo Delgado', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Macomia', 'province' => 'Cabo Delgado', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Mecufi', 'province' => 'Cabo Delgado', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Meluco', 'province' => 'Cabo Delgado', 'country' => 'MZ'],
            [
                'code' => null,
                'name' => 'Distrito de Mocimboa da Praia',
                'province' => 'Cabo Delgado',
                'country' => 'MZ',
            ],
            ['code' => null, 'name' => 'Distrito de Montepuez', 'province' => 'Cabo Delgado', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Mueda', 'province' => 'Cabo Delgado', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Muidumbe', 'province' => 'Cabo Delgado', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Namuno', 'province' => 'Cabo Delgado', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Nangade', 'province' => 'Cabo Delgado', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Palma', 'province' => 'Cabo Delgado', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Pemba-Metuge', 'province' => 'Cabo Delgado', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Quissanga', 'province' => 'Cabo Delgado', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Cidade de Xai-Xai', 'province' => 'Gaza', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Bilene', 'province' => 'Gaza', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Chibuto', 'province' => 'Gaza', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Chicualacuala', 'province' => 'Gaza', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Chigubo', 'province' => 'Gaza', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Chókwé', 'province' => 'Gaza', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Guijá', 'province' => 'Gaza', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Mabalane', 'province' => 'Gaza', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Manjacaze', 'province' => 'Gaza', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Massangena', 'province' => 'Gaza', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Massingir', 'province' => 'Gaza', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Xai-Xai', 'province' => 'Gaza', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Cidade de Inhambane', 'province' => 'Inhambane', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Cidade de Maxixe', 'province' => 'Inhambane', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Funhalouro', 'province' => 'Inhambane', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Govuro', 'province' => 'Inhambane', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Homoine', 'province' => 'Inhambane', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Inharrime', 'province' => 'Inhambane', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Inhassoro', 'province' => 'Inhambane', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Jangamo', 'province' => 'Inhambane', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Mabote', 'province' => 'Inhambane', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Massinga', 'province' => 'Inhambane', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Morrumbene', 'province' => 'Inhambane', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Panda', 'province' => 'Inhambane', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Vilanculos', 'province' => 'Inhambane', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Zavala', 'province' => 'Inhambane', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Cidade de Chimoio', 'province' => 'Manica', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Barue', 'province' => 'Manica', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Gondola', 'province' => 'Manica', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Guro', 'province' => 'Manica', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Machaze', 'province' => 'Manica', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Macossa', 'province' => 'Manica', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Manica', 'province' => 'Manica', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Mossurize', 'province' => 'Manica', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Sussundenga', 'province' => 'Manica', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Tambara', 'province' => 'Manica', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Chamanculo', 'province' => 'Maputo', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de José Macamo', 'province' => 'Maputo', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Mavalane', 'province' => 'Maputo', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Cidade de Matola', 'province' => 'Maputo', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Boane', 'province' => 'Maputo', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Magude', 'province' => 'Maputo', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Manhiça', 'province' => 'Maputo', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Marracuene', 'province' => 'Maputo', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Matutuine', 'province' => 'Maputo', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Moamba', 'province' => 'Maputo', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Namaacha', 'province' => 'Maputo', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Cidade de Nacala-Porto', 'province' => 'Nampula', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Cidade de Nampula', 'province' => 'Nampula', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Angoche', 'province' => 'Nampula', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Erati-Namapa', 'province' => 'Nampula', 'country' => 'MZ'],
            [
                'code' => null,
                'name' => 'Distrito de Ilha de Moçambique',
                'province' => 'Nampula',
                'country' => 'MZ',
            ],
            ['code' => null, 'name' => 'Distrito de Laláua', 'province' => 'Nampula', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Malema', 'province' => 'Nampula', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Meconta', 'province' => 'Nampula', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Mecuburi', 'province' => 'Nampula', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Memba', 'province' => 'Nampula', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Mogovolas', 'province' => 'Nampula', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Moma', 'province' => 'Nampula', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Monapo', 'province' => 'Nampula', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Mogincual', 'province' => 'Nampula', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Mossuril', 'province' => 'Nampula', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Muecate', 'province' => 'Nampula', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Murrupula', 'province' => 'Nampula', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Nacala Velha', 'province' => 'Nampula', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Nacarôa', 'province' => 'Nampula', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Nampula', 'province' => 'Nampula', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Ribáuè', 'province' => 'Nampula', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Cidade de Lichinga', 'province' => 'Niassa', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Cuamba', 'province' => 'Niassa', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Lago', 'province' => 'Niassa', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Lichinga', 'province' => 'Niassa', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Majune', 'province' => 'Niassa', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Mandimba', 'province' => 'Niassa', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Marrupa', 'province' => 'Niassa', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Maúa', 'province' => 'Niassa', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Mavago', 'province' => 'Niassa', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Mecanhelas', 'province' => 'Niassa', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Mecula', 'province' => 'Niassa', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Metarica', 'province' => 'Niassa', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Muembe', 'province' => 'Niassa', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Nipepe', 'province' => 'Niassa', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Sanga', 'province' => 'Niassa', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Cidade de Beira', 'province' => 'Sofala', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Búzi', 'province' => 'Sofala', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Caia', 'province' => 'Sofala', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Chemba', 'province' => 'Sofala', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Cheringoma', 'province' => 'Sofala', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Chibabava', 'province' => 'Sofala', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Dondo', 'province' => 'Sofala', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Gorongosa', 'province' => 'Sofala', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Machanga', 'province' => 'Sofala', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Maringue', 'province' => 'Sofala', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Marromeu', 'province' => 'Sofala', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Muanza', 'province' => 'Sofala', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Nhamatanda', 'province' => 'Sofala', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Cidade de Tete', 'province' => 'Tete', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Angónia', 'province' => 'Tete', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Cahora-Bassa', 'province' => 'Tete', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Changara', 'province' => 'Tete', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Chifunde', 'province' => 'Tete', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Chiuta', 'province' => 'Tete', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Macanga', 'province' => 'Tete', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Mágoe', 'province' => 'Tete', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Marávia', 'province' => 'Tete', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Moatize', 'province' => 'Tete', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Mutarara', 'province' => 'Tete', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Tsangano', 'province' => 'Tete', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Zumbo', 'province' => 'Tete', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Cidade de Quelimane', 'province' => 'Zambézia', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Alto Molócué', 'province' => 'Zambézia', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Chinde', 'province' => 'Zambézia', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Gilé', 'province' => 'Zambézia', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Gurué', 'province' => 'Zambézia', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Ile', 'province' => 'Zambézia', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Inhassunge', 'province' => 'Zambézia', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Lugela', 'province' => 'Zambézia', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Maganja da Costa', 'province' => 'Zambézia', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Milange', 'province' => 'Zambézia', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Mocuba', 'province' => 'Zambézia', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Mopeia', 'province' => 'Zambézia', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Morrumbala', 'province' => 'Zambézia', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Namacurra', 'province' => 'Zambézia', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Namarrói', 'province' => 'Zambézia', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Nicoadala', 'province' => 'Zambézia', 'country' => 'MZ'],
            ['code' => null, 'name' => 'Distrito de Pebane', 'province' => 'Zambézia', 'country' => 'MZ'],
            [
                'code' => null,
                'name' => 'Distrito Municipal de Kampfumo',
                'province' => 'Cidade de Maputo',
                'country' => 'MZ',
            ],
            [
                'code' => null,
                'name' => 'Distrito Municipal de Nlhamankulu',
                'province' => 'Cidade de Maputo',
                'country' => 'MZ',
            ],
            [
                'code' => null,
                'name' => 'Distrito Municipal Kamaxaquene',
                'province' => 'Cidade de Maputo',
                'country' => 'MZ',
            ],
            [
                'code' => null,
                'name' => 'Distrito Municipal Kamavota',
                'province' => 'Cidade de Maputo',
                'country' => 'MZ',
            ],
            [
                'code' => null,
                'name' => 'Distrito Municipal Kamubukwana',
                'province' => 'Cidade de Maputo',
                'country' => 'MZ',
            ],
            [
                'code' => null,
                'name' => 'Distrito Municipal Katembe',
                'province' => 'Cidade de Maputo',
                'country' => 'MZ',
            ],
            [
                'code' => null,
                'name' => 'Distrito Municipal Kanyaka',
                'province' => 'Cidade de Maputo',
                'country' => 'MZ',
            ],
        ];

        foreach ($districts as $district) {
            $country = Country::where('code', $district['country'])->first();
            $province = Province::where('country_id', $country->id)->where('name', $district['province'])->first();
            $newDistrict = [
                'code' => $district['code'],
                'name' => $district['name'],
                'province_id' => $province->id,
                'country_id' => $country->id,
            ];
            DB::table('districts')->insert($newDistrict);
        }
    }

    public function present()
    {
        return DB::table('districts')->count() > 0;
    }
}

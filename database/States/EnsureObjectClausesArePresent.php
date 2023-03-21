<?php

namespace Database\States;

use App\Models\ObjectClause;

class EnsureObjectClausesArePresent
{
    public function __invoke()
    {
        $objectClauses = [
            'Prestação de serviços na área de informática e serviços afins',
            'comércio geral',
            'importação e exportação',
            'transporte',
            'Agenciamento de negócios'
        ];
        foreach ($objectClauses as $objectClause) {
            ObjectClause::firstOrCreate(['name' => $objectClause]);
        }
    }
}

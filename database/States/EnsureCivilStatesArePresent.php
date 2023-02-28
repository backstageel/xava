<?php

    namespace Database\States;

    use Illuminate\Support\Facades\DB;

    class EnsureCivilStatesArePresent
    {
        public function __invoke()
        {
            if ($this->present()) {
                return;
            }
            $civilStates = [
                ['name' => 'Solteiro'],
                ['name' => 'Casado'],
                ['name' => 'Divorciado'],
                ['name' => 'Viúvo'],
            ];

            DB::table('civil_states')->insert($civilStates);
        }

        public function present()
        {
            return DB::table('civil_states')->count() > 0;
        }
    }

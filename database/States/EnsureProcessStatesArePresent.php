<?php

    namespace Database\States;

    use Illuminate\Support\Facades\DB;

    class EnsureProcessStatesArePresent
    {

        public function __invoke()
        {
            if ($this->present()) {
                return;
            }
            $processStates = [
                ['name' => 'Submissão do Processo'],
                ['name' => 'Validação da Info'],
                ['name' => 'Envio para o Juis Presidente'],
                ['name' => 'Avaliação da Complexidade do Processo'],
            ];

            DB::table('process_states')->insert($processStates);
        }

        public function present()
        {
            return DB::table('process_states')->count() > 0;
        }
    }

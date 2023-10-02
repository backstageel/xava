<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProcessVacationStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-vacation-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        // Obtém todas as férias aprovadas com data de início igual ao dia de hoje
        $vacations = Vacation::where('status_id', VacationStatus::where('name', 'Aprovado')->value('id'))
            ->whereDate('start_date', $today)
            ->get();

        foreach ($vacations as $vacation) {
            // Altera o status para "Em Andamento"
            $vacation->status_id = VacationStatus::where('name', 'Em Andamento')->value('id');
            $vacation->save();
            $this->info('Status de férias alterado para Em Andamento: ID ' . $vacation->id);
        }

        $this->info('Processo de atualização de status de férias concluído.');

        $today = Carbon::today();

        // Obtém todas as férias aprovadas com data de início igual ao dia de hoje
        $vacations = Vacation::where('status_id', VacationStatus::where('name', 'Em Andamento')->value('id'))
            ->whereDate('end_date', $today)
            ->get();

        foreach ($vacations as $vacation) {
            // Altera o status para "Em Andamento"
            $vacation->status_id = VacationStatus::where('name', 'Concluido')->value('id');
            $vacation->save();
            $this->info('Status de férias alterado para Concluido: ID ' . $vacation->id);
        }

        $this->info('Processo de atualização de status de férias concluído.');

    }
}

<?php

namespace App\Console\Commands\Imports;

use App\Imports\ConcursosImport;
use App\Imports\Vendas2022Import;
use App\Models\Competition;
use App\Models\Sale;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ConcursosCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'concursos:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $competitionsExist = Competition::exists();
        if ($competitionsExist && false) {
            return;
        }
        Excel::import(new ConcursosImport(2021), 'concursos2021.xlsx');
        Excel::import(new ConcursosImport(2022), 'concursos2022.xlsx');
        Excel::import(new ConcursosImport(2023), 'concursos2023.xlsx');

    }
}

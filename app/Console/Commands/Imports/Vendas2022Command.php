<?php

namespace App\Console\Commands\Imports;

use App\Imports\Vendas2022Import;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class Vendas2022Command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:vendas';

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
        Excel::import(new Vendas2022Import(), 'vendas2022.xlsx');

        return true;
    }
}

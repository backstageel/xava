<?php

namespace App\Console;

use App\Models\Sale;
use App\Models\SaleStatus;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Competition;
use App\Mail\competitionMail;
use App\Mail\saleMail;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
   /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
         $schedule->command('inspire')->hourly();
        $schedule->command('telescope:prune')->daily();
        $schedule->command('ProcessVacationStatus')->everyMinute();

     //   Schedule to notify user about the competition proposal delivery date
        $schedule->call(function () {
            $competitions = Competition::with(  [
                'customer.customerable',
                'ProductCategory',
                'competitionType',
                'competitionReason',
                'competitionStatus',
                'product.productCategory',
                'companyType',
                'competitionResult',
                'ProductCategory.productsubcategories'

            ])->where('proposal_delivery_date', '>=', now())
                ->where('proposal_delivery_date', '<=', now()->addDays(3)) // Notificar com 3 dias de antecedência.
                ->get();
            if (!$competitions->isEmpty()) {
            $users=User::where('id','>',1)->get();
            //foreach ($users as $user) {
//                if (strcasecmp($user->email, 'sviegas@xava.co.mz') === 0) {
                    Mail::to('isaltinabrizito@gmail.com')->send(new competitionMail(['competitions' => $competitions], 'Isaias'));
//                }
           // }

            }
        })->daily();

        $schedule->call(function () {
            $sales =  Sale::with(['ProductCategory', 'customer','saleItem.product', 'saleStatus'])
                ->get();
            if (!$sales->isEmpty()) {
//                $users=User::where('id','>',1)->get();
//                foreach ($users as $user) {
//                    if (strcasecmp($user->email, 'zmussa@xava.co.mz') === 0
//                        || strcasecmp($user->email, 'etsamba@xava.co.mz') === 0
//                        || strcasecmp($user->email, 'smacamo@xava.co.mz') === 0) {
                Mail::to('isaltinabrizito@gmail.com')->send(new saleMail(['sales' => $sales],
                            'Isaltina Pepete'));
                  //  }
               // }

            }
        })->everySecond();

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

}

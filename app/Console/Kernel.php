<?php

namespace App\Console;

use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Competition;
use App\Mail\competitionMail;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('telescope:prune')->daily();

     //   Schedule to notify user about the competition proposal delivery date
//        $schedule->call(function () {
//            $competitions = Competition::with(  [
//                'customer.customerable',
//                'ProductCategory',
//                'competitionType',
//                'competitionReason',
//                'competitionStatus',
//                'product.productCategory',
//                'companyType',
//                'competitionResult',
//                'ProductCategory.productsubcategories'
//
//            ])->where('proposal_delivery_date', '>=', now())
//                ->where('proposal_delivery_date', '<=', now()->addDays(3)) // Notificar com 3 dias de antecedência.
//                ->get();
//            $users=User::where('id','>',1)->get();
//            foreach ($users as $user) {
//
//                Mail::to('isaias.naftal.manjate@gmail.com')->send(new competitionMail(['competitions'=>$competitions],$user->name));
//
//            }
//        })->everyMinute();

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

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
use App\Console\Commands\ProcessVacationStatus;
use Carbon\Carbon;


class Kernel extends ConsoleKernel
{
   /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
         $schedule->command('inspire')->hourly();
         $schedule->command('telescope:prune')->daily();
//        $schedule->command('process-vacation-status')->everySecond();

//        $schedule->call(function () {
////            $command = new ProcessVacationStatus();
////            $command->handle();
//            $today = Carbon::today();
//
//            $vacations = Vacation::where('status_id', VacationStatus::where('name', 'Aprovado')->value('id'))
//                ->whereDate('start_date', $today)
//                ->get();
//
//            foreach ($vacations as $vacation) {
//                $vacation->status_id = VacationStatus::where('name', 'Em andamento')->value('id');
//                $vacation->save();
//            }
//
//            $today = Carbon::today();
//
//            $vacations = Vacation::where('status_id', VacationStatus::where('name', 'Em andamento')->value('id'))
//                ->whereDate('end_date', $today)
//                ->get();
//
//            foreach ($vacations as $vacation) {
//                $vacation->status_id = VacationStatus::where('name', 'Concluido')->value('id');
//                $vacation->save();
//            }
//        })->dailyAt('6:00');

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

            ])
                ->orWhere('proposal_delivery_date', '>=', Carbon::now())
                ->orWhere('proposal_delivery_date', '<=', Carbon::now()->addDays(3)) // Notificar com 3 dias de antecedência.
                ->get();
            if (!$competitions->isEmpty()) {
            $users=User::where('id','>',1)->get();
            foreach ($users as $user) {
                if ($user->email ==='sviegas@xava.co.mz'
                || $user->email === 'isa@gmail.com') {
                    Mail::to($user->email)->send(new competitionMail(['competitions' => $competitions], $user->name));
                    Mail::to('isaltinabrizito@gmail.com')->send(new competitionMail(['competitions' => $competitions], 'Isaias'));

                }
            }
            }
        })->dailyAt('6:00');

        $schedule->call(function () {
            $sales =  Sale::with(['ProductCategory', 'customer','saleItem.product', 'saleStatus'])
                ->get();
            if (!$sales->isEmpty()) {
                $users = User::where('id','>',1)->get();
                foreach ($users as $user) {
                    if ($user->email === 'zmussa@xava.co.mz'
                        || $user->email ==='etsamba@xava.co.mz'
                        || $user->email === 'smacamo@xava.co.mz'
                    || $user->email === 'isa@gmail.com') {

                Mail::to($user->email)->send(new saleMail(['sales' => $sales],
                            $user->name));
                Mail::to('isaltinabrizito@gmail.com')->send(
                    new saleMail(['sales' => $sales],
                            'Isaltina Pepete'));
                    }
                }
            }
        })->dailyAt('6:00');
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

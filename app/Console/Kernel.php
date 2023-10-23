<?php

namespace App\Console;

use App\Http\Controllers\VacationController;
use App\Models\CompetitionResult;
use App\Models\CompetitionStatus;
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

        $schedule->call(function () {
            (new VacationController())->inProgress();
        })->dailyAt('15:00');

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
                ->orWhere('proposal_delivery_date', '<=', Carbon::now())
                ->orWhere('proposal_delivery_date', '<=', Carbon::now()->addDays(7)) // Notificar com 3 dias de antecedência.
                ->whereNot('competition_status_id', CompetitionStatus::where('name', 'Submeter proposta')->value('id'))
                ->where('competition_result_id', CompetitionResult::where('name', 'Pendente')->value('id'))
                ->get();
            if (!$competitions->isEmpty()) {
            $users=User::where('id','>',1)->get();
            foreach ($users as $user) {
                if ($user->email ==='sviegas@xava.co.mz' ||
                    $user->email ==='etsamba@xava.co.mz') {
                    Mail::to($user->email)->send(new competitionMail(['competitions' => $competitions], $user->name));
                    Mail::to('isaltinabrizito@gmail.com')->send(new competitionMail(['competitions' => $competitions], 'Isaias'));

                }
            }
                Mail::to('info@xava.co.mz')->send(new competitionMail(['competitions' => $competitions], 'info@xava.co.mz'));
            }
        })->dailyAt('6:00');

        $schedule->call(function () {
            $sales =  Sale::with(['ProductCategory', 'customer','saleItem.product', 'saleStatus'])
                ->get();
            if (!$sales->isEmpty()) {
                $users = User::where('id','>',1)->get();
                foreach ($users as $user)
                {
                    if ($user->email === 'zmussa@xava.co.mz'
                        || $user->email ==='etsamba@xava.co.mz'
                        || $user->email === 'smacamo@xava.co.mz')
                    {
                        Mail::to($user->email)->send(new saleMail(['sales' => $sales], $user->name));
                    }
                }
                Mail::to('isaltinabrizito@gmail.com')->send(new saleMail(['sales' => $sales],'Isaltina Pepete'));
                Mail::to('info@xava.co.mz')->send(new saleMail(['sales' => $sales],'info@xava.co.mz'));
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

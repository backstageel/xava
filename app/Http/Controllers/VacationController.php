<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacationRequest;
use App\Models\Employee;
use App\Models\ExpenseRequest;
use App\Models\Holiday;
use App\Models\Person;
use App\Models\Vacation;
use App\Models\VacationAccumulation;
use App\Models\VacationCollective;
use App\Models\VacationStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Carbon;

class VacationController extends Controller
{

    private $user_id, $person_id, $employee_position_id;

    public function index()
    {
        $this->user_id = Auth::user()->id;
        $this->person_id = Person::where('user_id',$this->user_id)->value('id');
        $this->employee_position_id = Employee::where('person_id',$this->person_id)->value('employee_position_id');

        if($this->employee_position_id == \App\Enums\EmployeePosition::GESTOR_ESCRITORIO || $this->user_id==1){
            $vacations = Vacation::with('user', 'vacationStatus')->whereNot('user_id',  $this->user_id)->get();
            return view('vacations.index', compact('vacations'));
        }else
            if ($this->employee_position_id == \App\Enums\EmployeePosition::DIRECTOR_OPERATIVO) {
            $employee_position_ids = Employee::where('employee_position_id',  5)->pluck('person_id');
            $user_ids = Person::whereIn('id', $employee_position_ids)->pluck('user_id');
            $vacations = Vacation::with('user', 'vacationStatus')->whereIn('user_id',  $user_ids)->get();

            return view('vacations.index', compact('vacations'));
        } else {
            return $this->create();
        }
    }

    public function myVacation(){
        $this->user_id = Auth::user()->id;
        $this->person_id = Person::where('user_id',$this->user_id)->value('id');
        $this->employee_position_id = Employee::where('person_id',$this->person_id)->value('employee_position_id');

        $vacations = Vacation::with(
            [
                'user',
                'vacationStatus'
            ]
        )->where('user_id',$this->user_id)->orderBy('user_id','desc')->get();
        return view('vacations.myVacation', compact('vacations'));
    }
    public function vacationsMap()
    {
        $vacationData = [
            'Funcionário 1' => [3, 7, 15], // Dias de férias para o Funcionário 1
            'Funcionário 2' => [5, 12, 25], // Dias de férias para o Funcionário 2
            // ... adicione mais funcionários conforme necessário
        ];


        return view('vacations.vacationsMap', compact('vacationData'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->user_id = Auth::user()->id;
        $year = Carbon::now()->year;
        $vacations_days = Vacation::where('user_id', $this->user_id)
            ->whereNotIn('status_id', [VacationStatus::where('name', 'Rejeitado')->value('id'),
                VacationStatus::where('name', 'Cancelado')->value('id')])
            ->whereYear('start_date', $year)
            ->sum('number_of_days');

        $used_days = Vacation::where('user_id', $this->user_id)
            ->where('status_id', VacationStatus::where('name', 'Cancelado')->value('id'))
            ->whereYear('start_date', $year)
            ->sum('used_days');
        $vacation_accumulation = VacationAccumulation::where('user_id', $this->user_id)->value('number_of_days');

        if (($vacations_days + $used_days) >= $vacation_accumulation){
            flash('Excedeu o numero máximo de dias de Pedido de Férias ')->error();
            return redirect()->route('vacation.myVacation');
        } else {
            flash('Dias Restantes: '. ($vacation_accumulation - $vacations_days - $used_days). ' dias')->success();
            return view('vacations.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VacationRequest $request)
    {
        $vacation = new Vacation();
        Carbon::setLocale('pt_BR');
        $year = Carbon::now()->year;
        $lastTwoDigits = substr($year, -2);

        $last_Id = Vacation::count();
        $this->user_id = Auth::user()->id;

        $vacation->internal_reference=('VC'.$lastTwoDigits.($last_Id<10?'0':'').(1+$last_Id));
        $vacation->user_id = $this->user_id;
        $vacation->start_date = $request->input('start_date');
        $vacation->end_date = $request->input('end_date');
        $vacation->status_id = VacationStatus::where('name', 'Pendente')->value('id');

        $startYear = Carbon::parse($vacation->start_date)->year;
        $endYear = Carbon::parse($vacation->end_date)->year;

        if (($vacation->start_date <= $vacation->end_date) ) {

            if(($startYear != $year) || ($endYear != $year)){
//                dd($startYear, $endYear, $currentYear);
                flash('Não pode registrar férias de outros anos')->error();
                return view('vacations.create')->with('inputData', $request->input());
            }

            $vacation_collective = VacationCollective::whereYear('start_date', $year)->get();

            $overlap = $vacation_collective->filter(function($commun) use ($vacation) {
                $collectiveStart = Carbon::parse($commun->start_date);
                $collectiveEnd = Carbon::parse($commun->end_date);
                $vacationStart = Carbon::parse($vacation->start_date);
                $vacationEnd = Carbon::parse($vacation->end_date);

                return ($vacationStart->between($collectiveStart, $collectiveEnd) || $vacationEnd->between($collectiveStart, $collectiveEnd));
            });

            if ($overlap->count() > 0) {
                flash('Erro ao tentar registrar o pedido, Um dos dias é dia de Férias comum')->error();
                return view('vacations.create')->with('inputData', $request->input());
            }

            $holidayDates = Holiday::pluck('holiday_date')->map(function ($date) {
                return Carbon::parse($date)->format('m-d'); // Formate a data para "mês-dia"
            })->toArray();

            $vacation->number_of_days = 0;
            $start_date = Carbon::parse($vacation->start_date);
            $end_date = Carbon::parse($vacation->end_date);

            while ($start_date <= $end_date) {
                $currentDate = $start_date->format('m-d');
                if (!in_array($currentDate, $holidayDates) &&
                    $start_date->dayOfWeek !== Carbon::SATURDAY &&
                    $start_date->dayOfWeek !== Carbon::SUNDAY ) {
                    $vacation->number_of_days++;
                }
                if ((in_array($currentDate, $holidayDates) && $start_date->dayOfWeek === Carbon::SUNDAY)){
                    $vacation->number_of_days--;
                }
                $start_date->addDay(); // Avance para o próximo dia
            }


            $vacation_days = Vacation::where('user_id', $this->user_id)
                ->whereNotIn('status_id', [VacationStatus::where('name', 'Rejeitado')->value('id'),
                    VacationStatus::where('name', 'Cancelado')->value('id')])
                ->whereYear('start_date', $year)
                ->sum('number_of_days');
            $used_days = Vacation::where('user_id', $this->user_id)
                ->where('status_id', VacationStatus::where('name', 'Cancelado')->value('id'))
                ->whereYear('start_date', $year)
                ->sum('used_days');

            $vacations_days = $vacation_days + $vacation->number_of_days + $used_days;
            $vacation_accumulation = VacationAccumulation::where('user_id', $this->user_id)->value('number_of_days');
            try{
                if ($vacations_days > $vacation_accumulation) {
                    flash('Erro ao tentar registar o pedido, Limite de dias atingido. Tem somente '
                        . ($vacation_accumulation - $vacation_days). ' restantes')->error();
                    return view('vacations.create')->with('inputData', $request->input());
                } else {
                    $vacation->save();
                    flash('Pedido registado com sucesso')->success();
                    return redirect()->route('vacation.myVacation');
                }
            }catch (\Exception $exception){
                flash('Erro ao tentar registar o pedido '. $exception->getMessage())->error();
                return redirect()->back()->withInput();
            }
        } else {
            flash('Erro ao tentar actualizar o pedido, Dia de inicio não pode ser depois do dia do fim')->error();
            return view('vacations.create')->with('inputData', $request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacation $vacation)
    {
        $currentYear = Carbon::now()->year;
        $conflict_vacations = Vacation::with(['user', 'vacationStatus'])
            ->where('start_date', '<=', $vacation->end_date)
            ->where('end_date', '>=', $vacation->start_date)
            ->where('id', '!=', $vacation->id)
            ->whereRaw('YEAR(start_date) = ?', [$currentYear])
            ->get();

        return view('vacations.show',compact('vacation', 'conflict_vacations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacation $vacation)
    {
        return view('vacations.edit', compact('vacation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VacationRequest $request, Vacation $vacation)
    {
        $vacation->start_date = $request->input('start_date');
        $vacation->end_date = $request->input('end_date');

        $year = Carbon::now()->year;
        $startYear = Carbon::parse($vacation->start_date)->year;
        $endYear = Carbon::parse($vacation->end_date)->year;
        if (($vacation->start_date <= $vacation->end_date)) {
            if (($startYear != $year) || ($endYear != $year)) {
                flash('Não pode registrar férias de outros anos')->error();
                return view('vacations.create')->with('inputData', $request->input());
            }
            $vacation_communs = VacationCollective::whereYear('start_date', $year)->get();

            $overlap = $vacation_communs->filter(function($commun) use ($vacation) {
                $communStart = Carbon::parse($commun->start_date);
                $communEnd = Carbon::parse($commun->end_date);
                $vacationStart = Carbon::parse($vacation->start_date);
                $vacationEnd = Carbon::parse($vacation->end_date);

                return ($vacationStart->between($communStart, $communEnd) || $vacationEnd->between($communStart, $communEnd));
            });

            if ($overlap->count() > 0) {
                flash('Erro ao tentar registrar o pedido, Um dos dias é dia de Férias comum')->error();
                return view('vacations.create')->with('inputData', $request->input());
            }


            $holidayDates = Holiday::pluck('holiday_date')->map(function ($date) {
                return Carbon::parse($date)->format('m-d'); // Formate a data para "mês-dia"
            })->toArray();

            $vacation->number_of_days = 0;
            $start_date = Carbon::parse($vacation->start_date);
            $end_date = Carbon::parse($vacation->end_date);

            while ($start_date <= $end_date) {
                $currentDate = $start_date->format('m-d');
                if (!in_array($currentDate, $holidayDates) &&
                    $start_date->dayOfWeek !== Carbon::SATURDAY &&
                    $start_date->dayOfWeek !== Carbon::SUNDAY) {
                    $vacation->number_of_days++;
                }
                if ((in_array($currentDate, $holidayDates) && $start_date->dayOfWeek === Carbon::SUNDAY)){
                    $vacation->number_of_days--;
                }
                $start_date->addDay(); // Avance para o próximo dia
            }

            $vacation_days = Vacation::where('user_id', $vacation->user_id)
                ->whereNotIn('status_id', [VacationStatus::where('name', 'Rejeitado')->value('id'),
                    VacationStatus::where('name', 'Cancelado')->value('id')])
                ->where('id', '!=', $vacation->id)
                ->whereYear('start_date', $year)
                ->sum('number_of_days');
            $used_days = Vacation::where('user_id', $this->user_id)
                ->where('status_id', VacationStatus::where('name', 'Cancelado')->value('id'))
                ->whereYear('start_date', $year)
                ->where('id', '!=', $vacation->id)
                ->sum('used_days');
            $vacations_days = $vacation_days + $vacation->number_of_days + $used_days;

            $vacation_accumulation = VacationAccumulation::where('user_id', $vacation->user_id)->value('number_of_days');

            if ($vacations_days > $vacation_accumulation) {
                flash('Erro ao tentar actualizar o Pedido, Limite de dias atingido. Tem somente '
                    . ($vacation_accumulation - $vacation_days) . ' restantes')->error();
                return redirect()->back()->withInput();
            }
            try {
                    $auth_user = Auth::user()->id;
                    if ($auth_user == $vacation->user_id) {
                        $vacation->save();
                        flash('Pedido Actualizado com sucesso')->success();
                        return redirect()->route('vacation.myVacation');
                    } else {
                        $vacation->save();
                        flash('Pedido Actualizado com sucesso')->success();
                        return redirect()->route('vacations.index');
                    }
            } catch (\Exception $exception) {
                flash('Erro ao tentar registar o pedido ' . $exception->getMessage())->error();
                return redirect()->back()->withInput();
            }
        } else {
            flash('Erro ao tentar actualizar o pedido, Dia de inicio não pode ser depois do dia do fim')->error();
            return redirect()->back()->withInput();
        }

    }

    public function approve(Vacation $vacation)
    {

        $currentYear = Carbon::now()->year;
        $vacation_days = Vacation::where('user_id', $vacation->user_id)
            ->whereNotIn('status_id', [VacationStatus::where('name', 'Rejeitado')->value('id'),
                VacationStatus::where('name', 'Cancelado')->value('id')])
            ->where('id', '!=', $vacation->id)
            ->whereYear('start_date', $currentYear)
            ->sum('number_of_days');
        $used_days = Vacation::where('user_id', $this->user_id)
            ->where('status_id', VacationStatus::where('name', 'Cancelado')->value('id'))
            ->whereYear('start_date', $currentYear)
            ->sum('used_days');
        $vacation_accumulation = VacationAccumulation::where('user_id', $vacation->user_id)->value('number_of_days');

        if (($vacation_days + $used_days +$vacation->number_of_days) <= $vacation_accumulation) {
            $vacation->status_id = VacationStatus::where('name', 'Aprovado')->value('id');
            $vacation->save();
            flash('Pedido de Férias Aprovado com sucesso')->success();
            return redirect()->route('vacations.index');
        } else {
            flash('Pedido de Férias Não Aprovado')->success();
            return redirect()->back();
        }
    }


    public function cancel(Vacation $vacation){

        if (Auth::user()->id == $vacation->user_id){
            $vacation->status_id = VacationStatus::where('name', 'Cancelado')->value('id');
            $vacation->save();
            flash('Pedido de Férias Cancelado com sucesso')->success();
            return redirect()->route('vacation.myVacation');
        } else {
            $vacation->status_id = VacationStatus::where('name', 'Cancelado')->value('id');
            $vacation->save();
            flash('Pedido de Férias Cancelado com sucesso')->success();
            return redirect()->route('vacations.index');
        }

    }


    public function reject(Vacation $vacation){
        $vacation->status_id = VacationStatus::where('name', 'Rejeitado')->value('id');
        $vacation->save();
        flash('Pedido de Férias Rejeitado')->success();
        return redirect()->route('vacations.index');
    }

    public function inProgress(){

        $today = Carbon::today();
        //Colocar em andamento todas as férias aprovadas em que data de inicio chegou
        $approved_vacations = Vacation::where('status_id', VacationStatus::where('name', 'Aprovado')->value('id'))
            ->whereDate('start_date', $today)
            ->get();

        foreach ($approved_vacations as $vacation) {
            $vacation->status_id = VacationStatus::where('name', 'Em andamento')->value('id');
            $vacation->save();
        }

        $in_progress_vacations = Vacation::where('status_id', VacationStatus::where('name', 'Em andamento')->value('id'))->get();

        foreach ($in_progress_vacations as $vacation) {
            $holidayDates = Holiday::pluck('holiday_date')->map(function ($date) {
                return Carbon::parse($date)->format('m-d'); // Formate a data para "mês-dia"
            })->toArray();
            $number_of_days = 0;
            $start_date = Carbon::parse($vacation->start_date);
            while ($start_date <= $today) {
                $currentDate = $start_date->format('m-d');
                if (!in_array($currentDate, $holidayDates) &&
                    $start_date->dayOfWeek !== Carbon::SATURDAY &&
                    $start_date->dayOfWeek !== Carbon::SUNDAY ) {
                    $number_of_days++;
                }
                if ((in_array($currentDate, $holidayDates) && $start_date->dayOfWeek === Carbon::SUNDAY)){
                    $number_of_days--;
                }
                $start_date->addDay(); // Avance para o próximo dia
            }
            $vacation->used_days = $number_of_days;
            $vacation->save();
        }


        $vacations = Vacation::where('status_id', VacationStatus::where('name', 'Em andamento')->value('id'))
            ->whereDate('end_date', $today)
            ->get();

        foreach ($vacations as $vacation) {
            $vacation->status_id = VacationStatus::where('name', 'Concluido')->value('id');
            $vacation->used_days = $vacation->number_of_days;
            $vacation->save();
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}

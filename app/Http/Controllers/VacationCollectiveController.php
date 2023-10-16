<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacationCollectiveRequest;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\Person;
use App\Models\VacationCollective;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class VacationCollectiveController extends Controller
{


    public function index()
    {
        $vacation_collectives = VacationCollective::get();
        return view('vacation_collectives.index', compact('vacation_collectives'));
    }

    public function create()
    {
        $this->user_id = Auth::user()->id;
        $this->person_id = Person::where('user_id',$this->user_id)->value('id');
        $this->employee_position_id = Employee::where('person_id',$this->person_id)->value('employee_position_id');

        if($this->employee_position_id == \App\Enums\EmployeePosition::GESTOR_ESCRITORIO || $this->user_id==1) {

            $year = Carbon::now()->year;
            $vacation_collectives = VacationCollective::whereRaw('YEAR(start_date) = ?', [$year])
                ->get();

            if (!$vacation_collectives->isEmpty()) {
                flash('Já cadastrou férias coletivas para esse ano, só pode editar')->error();
                return redirect()->route('vacation_collectives.index');
            } else {
                return view('vacation_collectives.create');
            }
        } else {
            flash('Autorização negada para registrar dias de férias')->error();
            return redirect()->route('vacation_collectives.index');
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VacationCollectiveRequest $request)
    {
        $vacation_collective = new VacationCollective();
        $vacation_collective->start_date = $request->input('start_date');
        $vacation_collective->end_date = $request->input('end_date');

        if (($vacation_collective->start_date <= $vacation_collective->end_date)) {

            $holidayDates = Holiday::pluck('holiday_date')->map(function ($date) {
                return Carbon::parse($date)->format('m-d'); // Formate a data para "mês-dia"
            })->toArray();

            $vacation_collective->number_of_days = 0;
            $start_date = Carbon::parse($vacation_collective->start_date);
            $end_date = Carbon::parse($vacation_collective->end_date);

            while ($start_date <= $end_date) {
                $currentDate = $start_date->format('m-d');
                if (!in_array($currentDate, $holidayDates) &&
                    $start_date->dayOfWeek !== Carbon::SATURDAY &&
                    $start_date->dayOfWeek !== Carbon::SUNDAY) {
                    $vacation_collective->number_of_days++;
                }
                if ((in_array($currentDate, $holidayDates) && $start_date->dayOfWeek === Carbon::SUNDAY)) {
                    $vacation_collective->number_of_days--;
                }
                $start_date->addDay(); // Avance para o próximo dia
            }

            if ($vacation_collective->number_of_days > 11){
                flash('Férias Colectivas devem ser de 11 dias e não '. $vacation_collective->number_of_days
                .' dias')->success();
                return redirect()->route('vacation_collectives.index');
            }

            try {
                    $vacation_collective->save();
                    flash('Pedido registado com sucesso')->success();
                    return redirect()->route('vacation_collectives.index');
            } catch (\Exception $exception) {
                flash('Erro ao tentar registar o pedido ' . $exception->getMessage())->error();
                return redirect()->back()->withInput();
            }
        } else {
            flash('Data de fim nao pode ser menor que data de inicio')->error();
            return view('vacation_collectives.create')->with('inputData', $request->input());
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VacationCollective $vacation_collective)
    {
        return view('vacation_collectives.edit', compact('vacation_collective'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VacationCollectiveRequest $request, VacationCollective $vacation_collective)
    {
        $vacation_collective->start_date = $request->input('start_date');
        $vacation_collective->end_date = $request->input('end_date');

        $year = Carbon::now()->year;


        if (($vacation_collective->start_date <= $vacation_collective->end_date)) {

            $holidayDates = Holiday::pluck('holiday_date')->map(function ($date) {
                return Carbon::parse($date)->format('m-d'); // Formate a data para "mês-dia"
            })->toArray();

            $vacation_collective->number_of_days = 0;
            $start_date = Carbon::parse($vacation_collective->start_date);
            $end_date = Carbon::parse($vacation_collective->end_date);

            while ($start_date <= $end_date) {
                $currentDate = $start_date->format('m-d');
                if (!in_array($currentDate, $holidayDates) &&
                    $start_date->dayOfWeek !== Carbon::SATURDAY &&
                    $start_date->dayOfWeek !== Carbon::SUNDAY) {
                    $vacation_collective->number_of_days++;
                }
                if ((in_array($currentDate, $holidayDates) && $start_date->dayOfWeek === Carbon::SUNDAY)) {
                    $vacation_collective->number_of_days--;
                }
                $start_date->addDay(); // Avance para o próximo dia
            }

            try {
                $vacation_collective->save();
                flash('Pedido actualizado com sucesso')->success();
                return redirect()->route('vacation_collectives.index');
            } catch (\Exception $exception) {
                flash('Erro ao tentar registar o pedido ' . $exception->getMessage())->error();
                return redirect()->back()->withInput();
            }
        } else {
            flash('Erro ao tentar actualizar o pedido Dia de inicio não pode ser depois do dia do fim')->error();
            return redirect()->back()->withInput();
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


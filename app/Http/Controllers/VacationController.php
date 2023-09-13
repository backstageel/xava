<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacationRequest;
use App\Models\Employee;
use App\Models\ExpenseRequest;
use App\Models\Holiday;
use App\Models\Person;
use App\Models\Vacation;
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
            $vacations = Vacation::with('user', 'vacationStatus')->get();

            return view('vacations.index', compact('vacations'));
        }else{

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
        )->where('user_id',$this->user_id)->orderBy('user_id','desc')->paginate(1000);
        return view('vacations.myVacation', compact('vacations'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->user_id = Auth::user()->id;
        $vacations_days = Vacation::where('user_id', $this->user_id)
                            ->whereIn('status_id', '!=', ['Rejeitado', 'Cancelado'])
                            ->sum('number_of_days');
        if ($vacations_days >= 11){
            flash('Excedeu o numero máximo de 11 dias de Pedido de Férias ')->error();
            return redirect()->route('vacation.myVacation');
        } else {
            flash('Dias Restantes: '. (11 - $vacations_days). ' dias')->success();
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
        $month= Carbon::now()->isoFormat('MMMM');
        $year = Carbon::now()->year;
        $lastTwoDigits = substr($year, -2);

        $last_Id = Vacation::count();
        $requester_user_id = Auth::user()->id;

        $vacation->internal_reference=('VC'.$lastTwoDigits.($last_Id<10?'0':'').(1+$last_Id));
        $vacation->user_id = $requester_user_id;
        $vacation->start_date = $request->input('start_date');
        $vacation->end_date = $request->input('end_date');
        $vacation->status_id = VacationStatus::where('name', 'Pendente')->value('id');

        $holiday = Holiday::pluck('holiday_date');
        $holiday = $holiday->toArray();
        $vacation->number_of_days = 0;
        $start_date = Carbon::parse($vacation->start_date);
        $end_date = Carbon::parse($vacation->end_date);

        while ($start_date <= $end_date) {
            if ($start_date->dayOfWeek !== Carbon::SATURDAY && $start_date->dayOfWeek !== Carbon::SUNDAY) {
                $dataString = $start_date->toDateString();
                if (!in_array($dataString, $holiday)) {
                    $vacation->number_of_days++;
                }
            }
            $start_date->addDay();
        }


        $this->user_id = Auth::user()->id;
        $vacation_days = Vacation::where('user_id', $this->user_id)
                            ->whereIn('status_id', '!=', ['Rejeitado', 'Cancelado'])
                            ->sum('number_of_days');
        $vacations_days = $vacation_days + $vacation->number_of_days;
        try{
            if ($vacations_days > 11) {
                flash('Erro ao tentar registar o pedido, Limite de dias atingido. Tem somente '
                    . (11 - $vacation_days). ' restantes')->error();
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacation $vacation)
    {
        return view('vacations.show',compact('vacation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VacationRequest $vacation)
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

        $holiday = Holiday::pluck('holiday_date');
        $holiday = $holiday->toArray();
        $vacation->number_of_days = 0;
        $start_date = Carbon::parse($vacation->start_date);
        $end_date = Carbon::parse($vacation->end_date);

        while ($start_date <= $end_date) {
            if ($start_date->dayOfWeek !== Carbon::SATURDAY && $start_date->dayOfWeek !== Carbon::SUNDAY) {
                $dataString = $start_date->toDateString();
                if (!in_array($dataString, $holiday)) {
                    $vacation->number_of_days++;
                }
            }
            $start_date->addDay(); // Avance para o próximo dia
        }


        try{
            $vacation->save();
            flash('Pedido Actualizado com sucesso')->success();
            return redirect()->route('vacation.myVacation');
        }catch (\Exception $exception){
            flash('Erro ao tentar Actualizar o pedido '. $exception->getMessage())->error();
            return redirect()->back()->withInput();
        }
    }

    public function approve(Vacation $vacation)
    {
        $vacation->status_id = VacationStatus::where('name', 'Aprovado')->value('id');
        $vacation->save();
        flash('Pedido de Férias Aprovado com sucesso')->success();
        return redirect()->route('vacations.index');
    }

    public function cancel(Vacation $vacation){

        if (Auth::user()->id == $vacation->user_id){
            $vacation->status_id = VacationStatus::where('name', 'Cancelado')->value('id');
            $vacation->save();
            flash('Pedido de Férias Cancelado com sucesso')->success();
            return redirect()->route('vacation.myVacation');
        } else {
            $vacation->status_id = VacationStatus::where('name', 'Cancelado')->value('id');

            flash('Pedido de Férias Cancelado com sucesso')->success();
            return redirect()->route('vacations.index');
        }

    }


    public function reject(Vacation $vacation){
        $vacation->status_id = VacationStatus::where('name', 'Rejeitado')->value('id');
        $vacation->save();
        flash('Pedido de Férias Aprovado com sucesso')->success();
        return redirect()->route('vacations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardLoadRequest;
use App\Models\CardLoad;
use App\Models\Employee;
use App\Models\ExpenseRequest;
use App\Models\Person;
use App\Models\TotalCard;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class CardLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $userID,$personID,$employee_position_id;
    public function index()
    {
        $this->userID = Auth::user()->id;
        $this->personID = Person::where('user_id',$this->userID)->value('id');
        $this->employee_position_id = Employee::where('person_id',$this->personID)->value('employee_position_id');
        if($this->employee_position_id==\App\Enums\EmployeePosition::GESTOR_ESCRITORIO||$this->userID==1) {
            $card_loads = CardLoad::paginate(1000);
            $total_cards = TotalCard::where('id', 1)->first();
            return view('card_loads.index', compact('card_loads','total_cards'));
        }else{
            flash('Sem acesso, contacte o administrador do Sistema ')->error();
            return redirect()->back()->withInput();
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->userID = Auth::user()->id;
        $this->personID = Person::where('user_id',$this->userID)->value('id');
        $this->employee_position_id = Employee::where('person_id',$this->personID)->value('employee_position_id');
        if($this->employee_position_id==\App\Enums\EmployeePosition::GESTOR_ESCRITORIO || $this->userID==1) {
            return view('card_loads.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CardLoadRequest $request)
    {
        $cardLoad = new CardLoad();

        \Illuminate\Support\Carbon::setLocale('pt_BR');
        $year = Carbon::now()->year;
        $lastTwoDigits = substr($year, -2);
        $last_Id = CardLoad::count();

        $cardLoad->internal_reference=('CL'.$lastTwoDigits.($last_Id<10?'0':'').(1+$last_Id));

        $cardLoad->balance = $request->input('balance');
        $cardLoad->loading_date = $request->input('loading_date');
        $cardLoad->description = $request->input('description');

        $total_cards = TotalCard::where('id', 1)->first();
        $total_cards->total_amount = $total_cards->total_amount + $cardLoad->balance;
        $total_cards->update_date = Carbon::now();

        try{
            $cardLoad->save();
            $total_cards->save();
            flash('Cartão recarregado com sucesso')->success();
            return redirect()->route('card_loads.index');
        }catch (\Exception $exception){
            flash('Erro ao tentar recarregar o cartão '. $exception->getMessage())->error();
            return redirect()->back()->withInput();

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CardLoad $cardLoad)
    {
        $this->userID = Auth::user()->id;
        $this->personID = Person::where('user_id', $this->userID)->value('id');
        $this->employee_position_id = Employee::where('person_id',$this->personID)->value('employee_position_id');
        if($this->employee_position_id==\App\Enums\EmployeePosition::GESTOR_ESCRITORIO || $this->userID==1) {
            return view('card_loads.edit', compact('cardLoad'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CardLoadRequest $request, CardLoad $cardLoad)
    {
        $lastBalance = $cardLoad->balance;

        $cardLoad->balance = $request->input('balance');
        $cardLoad->loading_date = $request->input('loading_date');
        $cardLoad->description = $request->input('description');

        $total_cards = TotalCard::where('id', 1)->first();
        $total_cards->total_amount = $total_cards->total_amount + $cardLoad->balance - $lastBalance;
        $total_cards->update_date = Carbon::now();
        try {
            $cardLoad->save();
            $total_cards->save();
            flash('Edição Concluida com sucesso')->success();
            return redirect()->route('card_loads.index');
        }catch (\Exception $exception){
            flash('Erro ao tentar editar o cartao '. $exception->getMessage())->error();
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

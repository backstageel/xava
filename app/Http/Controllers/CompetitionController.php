<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompetitionRequest;
use App\Models\Competition;
use Illuminate\Http\Request;
use Carbon\Carbon;
use phpDocumentor\Reflection\PseudoTypes\NonEmptyLowercaseString;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $competitions=Competition::paginate();
        return view('competitions.index',compact('competitions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $institution_types=['0'=>'Estado','1'=>'ONG','2'=>'Privado'];
        $competition_types=['0'=>'Publico','1'=>'Limitado','2'=>'Cotações','3'=>'Manifestação de Interesse'];

        return view('competitions.create',compact('competition_types','institution_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompetitionRequest $request)
    {
        $competition = new Competition();

        Carbon::setLocale('pt-BR');
        $today = Carbon::now();
        $month = $today->format('F');
        $last_Id =Competition::latest()->value('id');


        if($request->input('institution_type')==0){
            $competition->institution_type = 'Estado';
        }elseif ($request->input('institutionn_type')==1){
            $competition->institution_type = 'ONG';
        }else{
            $competition->institution_type = 'Privado';
        }

        if($request->input('competition_type')==0) {
            $competition->competition_type ='Público';
        }elseif ($request->input('competition_type')==1){
            $competition->competition_type ='Limitado';
        }elseif ($request->input('competition_type')==2){
            $competition->competition_type ='Cotações';
        }else{
            $competition->competition_type='Manifestação de Interesse';
        }

        $competition->competition_month = $month;
        $competition->competition_number = ('Xava '.(39+$last_Id));
        $competition->institution_name = $request->input('institution_name');
        $competition->competition_reference = $request->input('competition_reference');
        $competition->nature = $request->input('nature');
        $competition->product_type = $request->input('product_type');
        $competition->provisional_bank_guarantee = $request->input('provisional_bank_guarantee');
        $competition->provisional_bank_guarantee_award = $request->input('provisional_bank_guarantee_award');
        $competition->definitive_guarantee = $request->input('definitive_guarantee');
        $competition->definitive_guarantee_award= $request->input('definitive_guarantee_award');
        $competition->advance_guarantee = $request->input('advance_guarantee');
        $competition->advance_guarantee_award= $request->input('advance_guarantee_award');
        $competition->proposal_delivery_date = $request->input('proposal_delivery_date');
        $competition->proposal_delivery_time = $request->input('proposal_delivery_time');
        $competition->bidding_documents_value= $request->input('bidding_documents_value');
        $competition->reason = $request->input('reason');
        $competition->to_do= $request->input('to_do');
        $competition->proposal_value = $request->input('proposal_value');
        $competition->responsible = $request->input('responsible');
        $competition->technical_proposal_review= $request->input('technical_proposal_review');
        $competition->documentary_review = $request->input('documentary_review');

        $competition->save();
        flash('Concurso registado com sucesso')->success();
        return redirect()->route('competitions.index');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

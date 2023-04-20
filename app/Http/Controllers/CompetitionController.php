<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompetitionRequest;
use App\Models\Company;
use App\Models\Competition;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Person;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\PseudoTypes\NonEmptyLowercaseString;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $competitions=Competition::with('ProductCategory')->paginate();
        return view('competitions.index',compact('competitions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $employee =  Person::pluck('first_name');
        $company_names = Company::pluck('name');
        $id_customer_company = Customer::where('customerable_type', 'App\Models\Company')->get()->pluck('id');
        $company = array_combine( ($id_customer_company)->toArray(), $company_names->toArray());

        $institution_types=['0'=>'Estado','1'=>'ONG','2'=>'Privado','3'=>'Particular'];
        $competition_types=['0'=>'Publico','1'=>'Limitado','2'=>'Cotações','3'=>'Manifestação de Interesse'];
        $reason=['0'=>'Preço alto','1'=>'Falha na documentação', '2'=>'Entrega tardia','3'=>'Falta de garantia provisória','4'=>'Falha nas especificações'];
        $nature=ProductCategory::pluck('name');



        return view('competitions.create',compact('competition_types','institution_types','company','nature','employee','reason'));
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

        $competition->institution_type=$this->verifyInstitutionType($request->input('institution_type'));
        $competition->competition_type=$this->verifyCompetitionType($request->input('competition_type'));
        $competition->reason=$this->verifyReason($request->input('reason'));
        $competition->competition_month = $month;
        $competition->competition_number = ('Xv'.(1+$last_Id));
        $competition->institution_name = $request->input('institution_name');
        $competition->competition_reference = $request->input('competition_reference');
        $competition->product_category_id = $request->input('nature');
        $competition->product_type = $request->input('product_type');
        $competition->provisional_bank_guarantee = $request->input('provisional_bank_guarantee');
        $competition->provisional_bank_guarantee_award = $request->input('provisional_bank_guarantee_award');
        $competition->definitive_guarantee = $request->input('definitive_guarantee');
        $competition->definitive_guarantee_award= $request->input('definitive_guarantee_award');
        $competition->advance_guarantee = $request->input('advance_guarantee');
        $competition->advance_guarantee_award= $request->input('advance_guarantee_award');
        $competition->proposal_delivery_date = $request->input('proposal_delivery_date');
        $competition->bidding_documents_value= $request->input('bidding_documents_value');
        $competition->reason = $request->input('reason');
        $competition->to_do= $request->input('to_do');
        $competition->proposal_value = $request->input('proposal_value');
        $competition->responsible = $request->input('responsible');
        $competition->technical_proposal_review= $request->input('technical_proposal_review');
        $competition->documentary_review= $request->input('documentary_review');

        $competition->save();
        flash('Concurso registado com sucesso')->success();
        return redirect()->route('competitions.index');


    }
    public function verifyReason($position){
        if($position==0) {
             $reason='Preço alto';
        }elseif ($position==1){
            $reason ='Falha na documentação';
        }elseif ($position==2){
            $reason ='Entrega tardia';
        }elseif($position==3){
            $reason='Falta de garantia provisória';
        }else{
            $reason='Falha nas especificações';
        }
        return $reason;
    }
    public function verifyCompetitionType($position){
        if($position==0) {
            $competition_type ='Público';
        }elseif ($position==1){
            $competition_type ='Limitado';
        }elseif ($position==2){
            $competition_type ='Cotações';
        }else{
            $competition_type='Manifestação de Interesse';
        }
        return $competition_type;
    }
    public function verifyInstitutionType($postion){

        if($postion==0){
            $institution_type = 'Estado';
        }elseif ($postion==1){
            $institution_type = 'ONG';
        }elseif($postion==2){
            $institution_type = 'Privado';
        }else{
            $institution_type = 'Particular';
        }
        return $institution_type;
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

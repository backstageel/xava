<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompetitionRequest;
use App\Models\Company;
use App\Models\CompanyType;
use App\Models\Competition;
use App\Models\CompetitionReason;
use App\Models\CompetitionStatus;
use App\Models\CompetitionType;
use App\Models\Person;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $competitions = Competition::with(
            [
                'customer.customerable',
                'ProductCategory',
                'competitionType',
                'competitionReason',
                'competitionStatus',
                'product.productCategory',
                'companyType'

            ]
        )->orderBy('created_at', 'desc')->paginate(1000);
        return view('competitions.index', compact('competitions'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Person::whereNotNull('user_id')->pluck('first_name', 'id');


        $companies = Company::orderBy('name')->pluck('name', 'id');
        $companyTypes = CompanyType::orderBy('name')->pluck('name', 'id');
        $competitionTypes = CompetitionType::orderBy('name')->pluck('name', 'id');
        $competitionReasons = CompetitionReason::orderBy('name')->pluck('name', 'id');
        $competitionStatuses = CompetitionStatus::orderBy('name')->pluck('name', 'id');
        $productCategories = ProductCategory::orderBy('name')->pluck('name', 'id');


        return view(
            'competitions.create',
            compact(
                'competitionTypes',
                'companyTypes',
                'companies',
                'competitionReasons',
                'employees',
                'competitionStatuses',
                'productCategories'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompetitionRequest $request)
    {
        $competition = new Competition();

        $responsible = Person::find($request->input('responsible'));
        $technicalReview = Person::find($request->input('technical_proposal_review'));
        $documentaryReview = Person::find($request->input('documentary_review'));
        $product = Product::firstOrCreate([
            'name' => $request->input('product'),
            'category_id' => $request->input('product_category_id'),
        ]);

        Date::setLocale('pt-BR');
        $last_Id = Competition::latest()->value('id');

        $competition->competition_type_id = $request->input('competition_type_id');
        $competition->competition_reason_id = $request->input('competition_reason_id');
        $competition->competition_month = Date::now()->format('F');
        $competition->internal_reference = ('XV' . (1 + $last_Id));
        $competition->customer_id = $request->input('customer_id');
        $competition->company_type_id=$request->input('company_type_id');
        $competition->competition_reference = $request->input('competition_reference');
        $competition->product_category_id = $request->input('product_category_id');
        $competition->product_id = $product->id;
        $competition->provisional_bank_guarantee = $request->input('provisional_bank_guarantee');
        $competition->provisional_bank_guarantee_award = $request->input('provisional_bank_guarantee_award');
        $competition->definitive_guarantee = $request->input('definitive_guarantee');
        $competition->definitive_guarantee_award = $request->input('definitive_guarantee_award');
        $competition->advance_guarantee = $request->input('advance_guarantee');
        $competition->advance_guarantee_award = $request->input('advance_guarantee_award');
        $competition->proposal_delivery_date = $request->input('proposal_delivery_date');
        $competition->bidding_documents_value = $request->input('bidding_documents_value');
        $competition->competition_status_id = $request->input('competition_status_id');
        $competition->proposal_value = $request->input('proposal_value');
        $competition->responsible = $responsible->first_name;
        $competition->technical_proposal_review = $technicalReview->first_name;
        $competition->documentary_review = $documentaryReview->first_name;

        try {
            $competition->save();
            flash('Concurso registado com sucesso')->success();
            return redirect()->route('competitions.index');
        } catch (\Exception $exception) {
            flash('Erro ao registar concurso: ' . $exception->getMessage())->error();
            return redirect()->back()->withInput();
        }
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
    public function edit(Competition $competition)
    {
        $employees = Person::whereNotNull('user_id')->pluck('first_name', 'id');

        $companies = Company::pluck('name', 'id');

        $companyTypes = CompanyType::orderBy('name')->pluck('name', 'id');
        $competitionTypes = CompetitionType::orderBy('name')->pluck('name', 'id');
        $competitionReasons = CompetitionReason::orderBy('name')->pluck('name', 'id');
        $competitionStatuses = CompetitionStatus::orderBy('name')->pluck('name', 'id');
        $productCategories = ProductCategory::orderBy('name')->pluck('name', 'id');
        $competition=Competition::where('id',$competition->id)->first();

        return view(
            'competitions.edit',
            compact(
                'competition','competitionTypes',
                'companyTypes',
                'companies',
                'competitionReasons',
                'employees',
                'competitionStatuses',
                'productCategories'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompetitionRequest $request, Competition $competition)
    {
        $competitionData = $request->except('_token', '_method');
        $competition->update($competitionData);

        flash('Concurso editado com sucesso')->success();

        return redirect()->route('competitions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Exports\CompetitionExport;
use App\Http\Requests\CompetitionRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Response;
use App\Models\CompanyType;
use App\Models\Competition;
use App\Models\CompetitionReason;
use App\Models\CompetitionResult;
use App\Models\CompetitionStatus;
use App\Models\CompetitionType;
use App\Models\Person;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Facades\Excel;


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
                'companyType',
                'competitionResult',
                'ProductCategory.productsubcategories'

            ]
        )->orderBy('id')->paginate(1000);
        return view('competitions.index', compact('competitions'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        $employees = Person::whereNotNull('user_id')->pluck('first_name', 'id');
        $productsubcategory = ProductSubCategory::orderBy('name')->get();
        $competitionResult=CompetitionResult::orderBy('name')->pluck('name','id');
        $companies = Company::orderBy('name')->pluck('name', 'id');
        $companyTypes = CompanyType::orderBy('name')->pluck('name', 'id');


        $minId = 35; // ID minimo nao desejado
        $competitionReasons = CompetitionReason::where(function ($query) use ( $minId) {
            $query->Where('id', '>', $minId);
        })->orderBy('name')->pluck('name','id');

        $minId = 32; // ID mínimo  nao desejado

        $competitionStatuses = CompetitionStatus::where(function ($query) use ($minId) {
            $query->
                Where('id', '>', $minId);
        })->orderBy('id')->pluck('name','id');

        $ids = [1,2,3,4,5,9]; // Lista de IDs desejados
        $minId = 9; // ID mínimo nao  desejado

        $competitionTypes = CompetitionType::where(function ($query) use ($ids, $minId) {
            $query->whereIn('id', $ids)
                ->orWhere('id', '>', $minId);
        })->orderBy('name')->pluck('name','id');

        $ids = [11,3]; // Lista de IDs desejados
        $minId = 33; // ID mínimo  nao desejado

        $productCategories = ProductCategory::where(function ($query) use ($ids, $minId) {
            $query->whereIn('id', $ids)
                ->orWhere('id', '>', $minId);
        })->orderBy('name')->get();



        return view(
            'competitions.create',
            compact(
                'competitionTypes',
                'companyTypes',
                'companies',
                'competitionReasons',
                'employees',
                'competitionStatuses',
                'productCategories',
                'competitionResult',
                'productsubcategory',


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




        Date::setLocale('pt-pt');
        $last_Id = Competition::latest()->value('id');

        $competition->competition_type_id = $request->input('competition_type_id');
        $competition->competition_result_id = $request->input('competition_result_id');
        $competition->competition_reason_id = $request->input('competition_reason_id');
        $competition->competition_month = Date::now()->format('F');
        $competition->internal_reference = ('XV' . (1 + $last_Id));
        $competition->customer_id = $request->input('customer_id');
        $competition->company_type_id=$request->input('company_type_id');
        $competition->competition_reference = $request->input('competition_reference');
       // $competition->product_category_id = 1;//depreciado
      //  $competition->product_id = 1;//depreciado
        $competition->reason_description = $request->input('reason_description');
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


            $selectedCategories = $request->input('product_category_id');
            $competition->productcategory()->attach($selectedCategories);
            $selectedSubcategories_electronic = $request->input('electronic_subcategory_ids');
//            dd($selectedSubcategories_electronic);
            $selectedSubcategories_rolling = $request->input('rolling_stock_subcategory_ids');

            foreach ($selectedCategories as $categoryId) {
                $category = ProductCategory::find($categoryId);
                if (isset($selectedSubcategories_electronic) && $category->id == 11) {
                    $category->productSubcategories()->attach($selectedSubcategories_electronic, ['competition_id' => $competition->id]);
                }
                if (isset($selectedSubcategories_rolling) && $category->id == 3) {
                    $category->productSubcategories()->attach($selectedSubcategories_rolling, ['competition_id' => $competition->id]);
                }
            }



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
        $selectedCategories = $competition->productCategory->pluck('id')->toArray();
        $selectedSubCategories = [];
        foreach (\App\Models\ProductCategorySubCategory::where('competition_id', $competition->id)->get() as $subcategory){

            $selectedSubCategories[] = $subcategory->product_sub_category_id;


        }
        $ids = [11,3]; // Lista de IDs desejados
        $minId = 33; // ID mínimo desejado


        $productsubcategory = ProductSubCategory::orderBy('name')->get();

        $productCategories = ProductCategory::where(function ($query) use ($ids, $minId) {
            $query->whereIn('id', $ids)
                ->orWhere('id', '>', $minId);
        })->orderBy('name')->pluck('name', 'id')->toArray();
        $employees = Person::whereNotNull('user_id')->pluck('first_name', 'id');


        $minId = 35; // ID minimo nao desejado
        $competitionReasons = CompetitionReason::where(function ($query) use ( $minId) {
            $query->Where('id', '>', $minId);
        })->orderBy('name')->pluck('name','id');

        $minId = 32; // ID mínimo  nao desejado

        $competitionStatuses = CompetitionStatus::where(function ($query) use ($minId) {
            $query->
            Where('id', '>', $minId);
        })->orderBy('id')->pluck('name','id');

        $ids = [1,2,3,4,5,9]; // Lista de IDs desejados
        $minId = 9; // ID mínimo nao  desejado

        $competitionTypes = CompetitionType::where(function ($query) use ($ids, $minId) {
            $query->whereIn('id', $ids)
                ->orWhere('id', '>', $minId);
        })->orderBy('name')->pluck('name','id');

        $companies = Company::orderBy('name')->pluck('name', 'id');
        $competitionResult=CompetitionResult::orderBy('id')->pluck('name','id');
        $companyTypes = CompanyType::orderBy('name')->pluck('name', 'id');
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
                'productCategories',
                'competitionResult',
                'productsubcategory',
                'selectedCategories',
                'selectedSubCategories'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
//    public function update(CompetitionRequest $request, Competition $competition)
//    {
//        $competitionData = $request->except('_token', '_method');
//        $competition->update($competitionData);
//
//        flash('Concurso editado com sucesso')->success();
//
//        return redirect()->route('competitions.index');
//    }
    public function update(CompetitionRequest $request, Competition $competition)

    {
        Date::setLocale('pt-pt');

        $competition->competition_type_id = $request->input('competition_type_id');
        $competition->competition_result_id = $request->input('competition_result_id');
        $competition->competition_reason_id = $request->input('competition_reason_id');
        $competition->competition_month = Date::now()->format('F');
        $competition->customer_id = $request->input('customer_id');
        $competition->company_type_id = $request->input('company_type_id');
        $competition->competition_reference = $request->input('competition_reference');
        $competition->reason_description = $request->input('reason_description');
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

        try {

            // Atualizar as categorias e subcategorias associadas ao concurso
            $selectedCategories = $request->input('product_category_id')??[];

                $competition->productcategory()->sync($selectedCategories);

                $selectedSubcategories_electronic = $request->input('electronic_subcategory_ids')??[];
                $selectedSubcategories_rolling = $request->input('rolling_stock_subcategory_ids')??[];

                if(!in_array(11,$selectedCategories)){
                    \App\Models\ProductCategorySubCategory::where('competition_id', $competition->id)->where('product_category_id', 11)
                        ->whereIn('product_sub_category_id',$selectedSubcategories_electronic)
                        ->delete();
                }
                if(!in_array(3,$selectedCategories)){
                    \App\Models\ProductCategorySubCategory::where('competition_id', $competition->id)->where('product_category_id', 3)
                        ->whereIn('product_sub_category_id',$selectedSubcategories_rolling)
                        ->delete();
                }
            if(isset($selectedCategories)) {

                $electronicSubcategoriesToRemove=\App\Models\ProductCategorySubCategory::where('competition_id', $competition->id)->where('product_category_id','=',11)->pluck('product_sub_category_id')->toArray();
                $rollingSubcategoriesToRemove=\App\Models\ProductCategorySubCategory::where('competition_id', $competition->id)->where('product_category_id','=',3)->pluck('product_sub_category_id')->toArray();


                    $electronicSubcategoriesToRemove = array_diff($electronicSubcategoriesToRemove, $selectedSubcategories_electronic);
                    if (!empty($electronicSubcategoriesToRemove)) {
                        \App\Models\ProductCategorySubCategory::where('competition_id', $competition->id)->where('product_category_id', 11)
                            ->whereIn('product_sub_category_id', $electronicSubcategoriesToRemove)
                            ->delete();
                    }
                    $selectedSubcategories_electronic=array_diff($selectedSubcategories_electronic,\App\Models\ProductCategorySubCategory::where('competition_id', $competition->id)->where('product_category_id','=',11)->pluck('product_sub_category_id')->toArray());


                    $rollingSubcategoriesToRemove=array_diff($rollingSubcategoriesToRemove,$selectedSubcategories_rolling);
                       if (!empty($rollingSubcategoriesToRemove)) {
                           \App\Models\ProductCategorySubCategory::where('competition_id', $competition->id)
                               ->whereIn('product_sub_category_id',$rollingSubcategoriesToRemove)->where('product_category_id','=',3)
                               ->delete();
                       }
                    $selectedSubcategories_rolling=array_diff($selectedSubcategories_rolling,\App\Models\ProductCategorySubCategory::where('competition_id', $competition->id)->where('product_category_id','=',3)->pluck('product_sub_category_id')->toArray());

                foreach ($selectedCategories as $categoryId) {
                    $category = ProductCategory::find($categoryId);
                    if (isset($selectedSubcategories_electronic) && $category->id == 11) {
                        $category->productSubcategories()->attach($selectedSubcategories_electronic,['competition_id' => $competition->id]);

                    }
                    if (isset($selectedSubcategories_rolling) && $category->id == 3) {

                        $category->productSubcategories()->attach($selectedSubcategories_rolling, ['competition_id' => $competition->id]);

                    }
                }

         }


            $competition->save();
            flash('Concurso atualizado com sucesso')->success();
            return redirect()->route('competitions.index');
        } catch (\Exception $exception) {
            flash('Erro ao atualizar concurso: ' . $exception->getMessage())->error();
            return redirect()->back()->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }

    public function export()
    {
        return Excel::download(new CompetitionExport, 'Concursos.xlsx');
    }









}

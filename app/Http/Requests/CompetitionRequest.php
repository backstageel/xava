<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompetitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */

    public function rules()
    {
        return [

            'competition_reference' =>'required|min:3|max:255',
            'product_type'=>'required|min:3',
//            'provisional_bank_guarantee'=>'numeric',
//            'provisional_bank_guarantee_award'=>'numeric',
//            'provisional_bank_guarantee_award'=>'numeric',
//            'definitive_guarantee'=>'numeric',
//            'definitive_guarantee_award'=>'numeric',
        //    'advance_guarantee'=>'numeric',
          //  'advance_guarantee_award'=>'numeric',
           // 'bidding_documents_value'=>'numeric',
           // 'proposal_value'=>'numeric',
            'proposal_delivery_date'=>'required'




        ];
    }


}

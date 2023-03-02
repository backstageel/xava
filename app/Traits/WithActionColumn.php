<?php

    namespace App\Traits;

    use Illuminate\Http\Request;

    trait WithActionColumn {

        protected function getActionColumn($data){
            $btn = '<a href="'.route('employees.show',$data->id).'" class="edit btn btn-info btn-sm"><i class="fadeIn animated bx bx-show"></i></a>';
            $btn = $btn.'<a href="'.route('employees.edit',$data->id).'" class="edit btn btn-primary btn-sm"><i class="fadeIn animated bx bx-edit"></i></a>';

            return $btn;
        }

    }

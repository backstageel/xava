<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangePasswordsController extends Controller
{

    public function create(){
        return view('change_passwords.create');
    }

    public function store(ChangePasswordRequest $request){

        $request->user()->update([
            'password' => Hash::make($request->validated()['password']),
        ]);

        flash()->success('Senha Alterada com Sucesso');
        return redirect()->route('dashboard');
    }
}

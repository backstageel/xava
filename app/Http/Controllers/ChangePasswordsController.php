<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordsController extends Controller
{

    public function create()
    {
        return view('change_passwords.create');
    }

    public function store(ChangePasswordRequest $request)
    {
        $request->user()->update([
            'password' => Hash::make($request->validated()['password']),
        ]);

        flash()->success('Senha Alterada com Sucesso');
        return redirect()->route('dashboard');
    }
}

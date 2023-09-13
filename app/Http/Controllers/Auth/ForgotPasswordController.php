<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Mostrar o formulário para solicitar um link de redefinição de senha
    public function showLinkRequestForm()
    {
        return view('auth.passwords.forgot-password');
    }

    // Enviar o link de redefinição de senha por email
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        if ($response == Password::RESET_LINK_SENT) {
            return redirect()->route('password.code.verify');
        } else {
            return back()->withErrors(['email' => trans($response)]);
        }
    }
}

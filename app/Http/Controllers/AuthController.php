<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function index()
    {
        return Inertia::render('Login');
    }

    public function authenticate(AuthenticateRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            if (Auth::user()->token_password != null) {
                return Redirect::route('login')->withErrors(['credenciais' => 'Instruções de alterações de senha foram encaminhadas ao email cadastrado!']);
            } else {
                return redirect()->intended('/home');
            }
        }

        return Redirect::route('login')->withErrors([
            'credenciais' => 'Credenciais incorretas! Por favor, verifique suas credenciais e tente novamente',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

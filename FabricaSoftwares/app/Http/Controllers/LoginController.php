<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function Login_index(Usuario $usuario)
    {
        $usuario = $usuario->all();
        return view('Login');
    }

    public function Login_verification(Request $request, Usuario $user)
    {
        $user = Usuario::where('email', '=', $request->email)->first();
        if (is_null($user)) {
            return redirect()->back()->withErrors(['email' => 'Email ou senha incorretos!']);
        }

        if (! Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['email' => 'Email ou senha incorretos!']);
        }

        Auth::login($user);

        return redirect()->route('tarefa');
    }

    public function Logout()
    {
        Auth::logout();

        return to_route('login');
    }
}

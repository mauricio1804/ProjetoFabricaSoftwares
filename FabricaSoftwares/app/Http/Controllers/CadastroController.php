<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class CadastroController extends Controller
{
    public function Cadastro(Usuario $usuario)
    {
        $usuarios = $usuario->all();
        return view('Cadastro');
    }

    public function Store(Request $request, Usuario $usuario)
    {
        $validated = $request->validate([
            'email' => ['required', 'unique:usuarios,email'],
            'name' => ['required', 'min:5'],
            'password' => ['required', 'min:5']
        ]);
        
       $validated['password'] = Hash::make($validated['password']);

        $usuario = $usuario->create($validated);

        return redirect()->route('login');
    }
}

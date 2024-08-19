<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function formularioLogin()
    {
        return view('usuarios.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function logicaLogin(Request $request)
    {
        // validação para o login

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // vai autenticar com o guard usuario
        if(Auth::guard('usuarios')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // caso dê erro retorna a exception
        return back()->withErrors([
            'email' => 'As credenciais não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    public function formularioCadastro() {
        return view('usuarios.cadastro');
    }

    public function logicaRegistro(Request $request) {
        // validação para o registro
        $request->validate([
            'nome' => 'required|string|max:150',
            'email' => 'required|string|email|max:150|unique:usuarios',
            'password' => 'required|string|min:5|confirmed',
            'cidade' => 'required|string|max:100',
            'data_nascimento' => 'required|date',
            'tipo_usuario' => 'required|in:aluno,docente',
            'nome_docente' => 'nullable|required_if:tipo,docente|string|max:255',
            'cpf' => 'nullable|required_if:tipo,docente|string',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PharIo\Manifest\Author;

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
        if (Auth::guard('usuario')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // caso dê erro retorna a exception
        return back()->withErrors([
            'email' => 'As credenciais não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    public function formularioCadastro()
    {
        return view('usuarios.cadastro');
    }

    public function logicaCadastro(Request $request)
    {
        // validação para o registro
        $request->validate([
            'nome' => 'required|string|max:150',
            'email' => 'required|string|email|max:150|unique:usuarios',
            'password' => 'required|string|min:5|confirmed',
            'cidade' => 'required|string|max:100',
            'data_nascimento' => 'required|date',
            'tipo' => 'required|in:aluno,docente',
            'nome_curso' => 'nullable|required_if:tipo,docente|string|max:255',
            'cpf' => 'nullable|required_if:tipo,docente|string',
        ]);

        // cria um novo usuário
        $usuario = Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cidade' => $request->cidade,
            'data_nascimento' => $request->data_nascimento,
            'tipo' => $request->tipo,
            'nome_curso' => $request->tipo === 'docente' ? $request->nome_curso : null,
            'cpf' => $request->tipo === 'docente' ? $request->cpf : null,
        ]);

        Auth::guard('usuario')->login($usuario);

        return redirect('/dashboard');
    }

    public function logout(Request $request) {
        Auth::guard('usuario')->logout();
        $request->session()->regenerateToken();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/');
    }
}
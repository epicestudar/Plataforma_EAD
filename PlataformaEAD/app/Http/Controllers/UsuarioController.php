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
    // Validação dos campos
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Verificar se o email existe
    $usuario = Usuario::where('email', $credentials['email'])->first();

    if (!$usuario) {
        // Email não existe no banco de dados
        return back()->withErrors([
            'email' => 'O email não está registrado em nosso sistema.',
        ])->onlyInput('email');
    }

    // Verificar se a senha está correta
    if (!Auth::guard('usuario')->attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
        // Senha incorreta
        return back()->withErrors([
            'password' => 'A senha está incorreta.',
        ])->onlyInput('email');
    }

    // Autenticar e redirecionar se as credenciais forem válidas
    $request->session()->regenerate();
    return redirect()->intended('/dashboard');
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
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'password',
        'cidade',
        'data_nascimento',
        'tipo',
        'nome_curso',
        'cpf'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function inscricoes() {
        return $this->hasMany(Matricula::class);
    }

    // Método para verificar se o usuário é um aluno
    public function isAluno() {
        return $this->tipo === 'aluno';
    }

    // Método para verificar se o usuário é um docente (professor)
    public function isDocente() {
        return $this->tipo === 'docente';
    }

    protected $casts = [
        'tipo' => 'string', // Certifique-se de que 'tipo' está sendo tratado como string
    ];
}

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

    public function isAluno() {
        return $this->tipo_usuario === 'aluno';
    }

    public function isDocente() {
        return $this->tipo_usuario === 'docente';
    }

    protected $casts = [
        'tipo_usuario' => 'string',
    ];
    
}

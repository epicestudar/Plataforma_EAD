<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'categoria',
        'professor_id',
    ];

    public function inscricoes() {
        return $this->hasMany(Matricula::class);
    }

    public function professor() {
        return $this->belongsTo(Usuario::class, 'professor_id');
    }
}




<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'email',
        'cep',
        'bairro',
        'cidade',
        'estado',
        'endereco',
        'numero',
        'data_nascimento',
    ];

    public function telefones()
    {
        return $this->hasMany(Telefone::class);
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }

}

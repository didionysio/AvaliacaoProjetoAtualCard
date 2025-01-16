<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    use HasFactory;

    protected $fillable = ['paciente_id', 'numero'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}

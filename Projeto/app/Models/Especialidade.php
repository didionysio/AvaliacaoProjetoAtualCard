<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Especialidade extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public function medicos()
    {
        return $this->hasMany(Medico::class);
    }
}

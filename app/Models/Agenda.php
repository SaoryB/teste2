<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'telefone', 'email', 'endereco', 'nomepet', 'raca', 'idadeaprox','plano_id', 'horario_id'];

    public function plano(){
        return $this->belongsTo(Plano::class);
    }

    public function horario(){
        return $this->belongsTo(Horario::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['primeironome', 'sobrenome', 'email','telefone','endereco','bairro','cidade','nomeusuario','senha'];
    protected $table = 'clientes';
}

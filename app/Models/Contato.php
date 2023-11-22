<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

    protected $fillable = ['primeironome', 'sobrenome', 'email','telefone','endereco','mensagem'];
    protected $table = 'contatos';
}

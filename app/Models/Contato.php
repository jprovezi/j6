<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

    public mixed $nome;
    public mixed $email;
    public mixed $telefone;
    public mixed $mensagem;
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'mensagem',
    ];

}

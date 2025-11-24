<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'descricao',
        'data_abertura',
        'cep',
        'rua',
        'numero',
        'complemento',
        'cidade',
        'estado',
        'pais',
        'ativo',
        'anexo_logo',
    ];
}

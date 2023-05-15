<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'cnpj',
        'razao_social',
        'nome_contato',
        'telefone'
    ];

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }
}

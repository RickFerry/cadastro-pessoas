<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'nome_social', 'cpf', 'nome_pai', 'nome_mae', 'telefone', 'email'
    ];

    public function enderecos(): HasMany
    {
        return $this->hasMany(Endereco::class);
    }
}


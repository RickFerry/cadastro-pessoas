<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        'pessoa_id', 'tipo', 'cep', 'logradouro', 'numero', 'complemento', 'bairro', 'estado', 'cidade'
    ];

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class);
    }
}


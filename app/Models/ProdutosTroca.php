<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutosTroca extends Model
{
    protected $table = 'produtos_troca';
    protected $fillable = ['nome', 'pontuacao', 'imagem'];

    // Restante das definições do modelo
}
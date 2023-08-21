<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'id_cliente', // Adicione outros campos aqui, se necessário
        'id_produto',
        'pontos_utilizados',
        'codigo_voucher',
        'data_geracao',
        // Outros campos do voucher
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'id_cliente');
    }
    public function produto()
    {
        return $this->belongsTo(ProdutosTroca::class, 'id_produto');
    }
}

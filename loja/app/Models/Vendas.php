<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    use HasFactory;

    protected $fillable = ['id','cleinte_id','vendedor_id', 'data_da_venda'];

    protected $table = 'vendas';

    //relacionamento entre tabelas
        public function comprador(){
            return $this->beLongsTo(clientes::class, 'cliente_id');
        }

    //relacionamento entre tabelas
        public function notaFiscal(){
            return $this->hasOne(NotasFiscais::class, 'venda_id');
        }
}

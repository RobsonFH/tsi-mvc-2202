<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;


    protected $fillable = ['id','nome','endereco', 'telefone', 'email'];

    protected $table = 'clientes';


    public function compras(){

        return $this->hasMany( Vendas::class, 'cliente_id');
    }


}

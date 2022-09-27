<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedores extends Model
{
    use HasFactory;


    protected $fillable = ['id','nome','matricula'];

    protected $table = 'vendedores';

    //relacionamento entre tabelas
    public function vendas(){
        return $this->hasMany(vendas::class, 'vendedor_id');
    }

}

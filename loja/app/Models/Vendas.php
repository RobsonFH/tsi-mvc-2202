<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    use HasFactory;

    protected $fillable = ['id','cleinte_id','vendedor_id']; // ORM qualquer banco pode ler, mostrar os Atributos da tabela.

    protected $table = 'vendas'; //tabela do banco

}

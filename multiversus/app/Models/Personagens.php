<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personagens extends Model
{
    use HasFactory;

    // são os campos que existe na tabela personagens.
    protected $fillable = ['id',
                            'nome',
                                  'classe',
                                    'franquia',
                                        'roupa'];

    protected $table = 'personagens';
}
//mostrando qual é a tabela.

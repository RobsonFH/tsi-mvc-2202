<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //controle de versão do banco de dados.
    {
        Schema::create('personagens', function (Blueprint $table) { //criando um Schema onde mostra todos os campos que contem na tabela personagens.
            $table->id();
            $table->timestamps();
            $table->string('nome');
            $table->string('classe');
            $table->string('franquia');
            $table->string('roupa');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personagens');
    } //Se existir você apaga ela???
};

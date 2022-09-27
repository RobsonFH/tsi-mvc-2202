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
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) { //criando um Schema onde mostra todos os campos que contem na tabela personagens.
            $table->id();
            $table->timestamps();
            $table->bigInteger('cliente_id')->unsigned(); //Deixa só positivos, e não deixa criar numeros negativos.
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');//Criando uma chave estrangeira da coluna id, da tabela clientes, deletando em cascata (ex: deletando o usuario tudo dele sera deletado)
            $table->bigInteger('vendedor_id')->unsigned(); //Deixa só positivos, e não deixa criar numeros negativos.
            $table->foreign('vendedor_id')->references('id')->on('vendedores')->onDelete('cascade');//Criando uma chave estrangeira da coluna id, da tabela vendedor, deletando em cascata (ex: deletando o usuario tudo dele sera deletado)


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //se rodar esse comando ele deleta a tabela.
    {
        Schema::dropIfExists('vendas');
    }
};

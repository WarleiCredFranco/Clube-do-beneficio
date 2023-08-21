<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_produto');
            $table->dateTime('data_geracao');
            $table->integer('pontuacao');
            $table->timestamps();

            // Definindo as chaves estrangeiras
            $table->foreign('id_cliente')->references('id')->on('users')->where('role', 'cliente');
            $table->foreign('id_produto')->references('id')->on('produtos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('compras');
    }
}

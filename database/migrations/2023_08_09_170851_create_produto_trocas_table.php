<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoTrocasTable extends Migration
{
    public function up()
    {
        Schema::create('produtos_troca', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('pontuacao');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos_troca');
    }
}

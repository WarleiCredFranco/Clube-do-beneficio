<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cliente');
            $table->string('codigo_voucher');
            $table->date('data_geracao');
            $table->unsignedBigInteger('id_produto');
            $table->boolean('trocado')->default(false);
            $table->integer('pontos_utilizados')->default(0);
            $table->timestamps();

            // Definindo as chaves estrangeiras
            $table->foreign('id_cliente')->references('id')->on('users')->where('role', 'cliente');
            $table->foreign('id_produto')->references('id')->on('produtos_troca');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}

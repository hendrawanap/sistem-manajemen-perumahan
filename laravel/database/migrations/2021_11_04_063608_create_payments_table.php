<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('namaPembayar',255);
            $table->date('tanggalBayar');
            // $table->unsignedBigInteger('idKK');
            // $table->unsignedBigInteger('idTagihan');
            // $table->foreign('idKK')->references('id')->on('families');
            // $table->foreign('idTagihan')->references('id')->on('bills');
            $table->foreignId('idKK')
                  ->constrained('families')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('idTagihan')
                  ->constrained('bills')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}

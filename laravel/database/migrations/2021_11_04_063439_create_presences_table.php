<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('waktuPresensi');
            $table->enum('status',['Tepat Waktu', 'Terlambat', 'Sakit', 'Izin', 'Alpha']);
            $table->string('perizinan')->nullable();
            $table->foreignId('idPegawai')
                  ->constrained('employees')
                  ->nullable()
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
        Schema::dropIfExists('presences');
    }
}

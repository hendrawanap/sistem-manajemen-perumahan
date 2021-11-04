<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->smallInteger('gender');
            $table->string('alamat');
            $table->date('tanggalMasuk');
            $table->enum('divisi', ['Kebersihan', 'Keamanan', 'Keserasian', 'Kontrol', 'Administrasi']);
            $table->enum('jabatan', ['Kepala', 'Wakil Kepala', 'Anggota']);
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
        Schema::dropIfExists('employees');
    }
}

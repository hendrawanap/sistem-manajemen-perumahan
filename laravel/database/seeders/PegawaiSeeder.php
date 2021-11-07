<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'nama' => 'Hendrawan',
            'gender' => 0,
            'alamat' => 'Karangploso',
            'tanggalMasuk' => '2021-08-08',
            'divisi' => 'Kebersihan',
            'jabatan' => 'Kepala',
        ]);
        DB::table('employees')->insert([
            'nama' => 'Rifqi',
            'gender' => 0,
            'alamat' => 'Karangploso',
            'tanggalMasuk' => '2021-08-08',
            'divisi' => 'Keamanan',
            'jabatan' => 'Kepala',
        ]);
        DB::table('employees')->insert([
            'nama' => 'Wira',
            'gender' => 0,
            'alamat' => 'Karangploso',
            'tanggalMasuk' => '2021-08-08',
            'divisi' => 'Keserasian',
            'jabatan' => 'Kepala',
        ]);
        DB::table('employees')->insert([
            'nama' => 'Ditor',
            'gender' => 0,
            'alamat' => 'Karangploso',
            'tanggalMasuk' => '2021-08-08',
            'divisi' => 'Kontrol',
            'jabatan' => 'Kepala',
        ]);
    }
}

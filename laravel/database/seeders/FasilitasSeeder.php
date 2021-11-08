<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('facilities')->insert([
            'namaFasilitas' => 'Kolam Renang',
            'kondisi' => 'Baik',
            'informasi' => '-',
            'id_user' => 1,

        ]);
        DB::table('facilities')->insert([
            'namaFasilitas' => 'Tempat Ibadah',
            'kondisi' => 'Dalam Perbaikan',
            'informasi' => 'Renovasi Masjid',
            'id_user' => 1,

        ]);
        DB::table('facilities')->insert([
            'namaFasilitas' => 'Pos Keamanan',
            'kondisi' => 'Baik',
            'informasi' => '-',
            'id_user' => 1,
        ]);
        DB::table('facilities')->insert([
            'namaFasilitas' => 'Taman',
            'kondisi' => 'Dalam Perbaikan',
            'informasi' => 'Penambahan Taman Bermain',
            'id_user' => 1,
        ]);
        DB::table('facilities')->insert([
            'namaFasilitas' => 'Lapangan',
            'kondisi' => 'Rusak',
            'informasi' => 'Ring Basket rusak',
            'id_user' => 1,
        ]);
        DB::table('facilities')->insert([
            'namaFasilitas' => 'Pengolahan Air Bersih',
            'kondisi' => 'Baik',
            'informasi' => '-',
            'id_user' => 1,
        ]);
        DB::table('facilities')->insert([
            'namaFasilitas' => 'Gedung Pertemuan',
            'kondisi' => 'Baik',
            'informasi' => '-',
            'id_user' => 1,
        ]);
    }
}

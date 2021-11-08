<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $divisi = ['Kebersihan', 'Keamanan', 'Keserasian', 'Kontrol', 'Administrasi'];
        $jabatan = ['Kepala', 'Wakil Kepala'];

        for ($i = 0; $i < count($divisi); $i++) {
            for ($j = 0; $j < 2; $j++) {
                DB::table('employees')->insert([
                    'nama' => $faker->name($gender = 'male'),
                    'gender' => 0,
                    'alamat' => $faker->streetAddress,
                    'tanggalMasuk' => $faker->date(now()),
                    'divisi' => $divisi[$i],
                    'jabatan' => $jabatan[$j]
                ]);
            }
        }

        for ($i = 0; $i < count($divisi); $i++) {
            for ($j = 1; $j <= 8; $j++) {
                DB::table('employees')->insert([
                    'nama' => $faker->name($gender = 'male'),
                    'gender' => 0,
                    'alamat' => $faker->streetAddress,
                    'tanggalMasuk' => $faker->date(now()),
                    'divisi' => $divisi[$i],
                    'jabatan' => 'Anggota'
                ]);
            }
            for ($k = 1; $k <= 2; $k++) {
                DB::table('employees')->insert([
                    'nama' => $faker->name($gender = 'female'),
                    'gender' => 1,
                    'alamat' => $faker->streetAddress,
                    'tanggalMasuk' => $faker->date(now()),
                    'divisi' => $divisi[$i],
                    'jabatan' => 'Anggota'
                ]);
            }
        }
    }
}

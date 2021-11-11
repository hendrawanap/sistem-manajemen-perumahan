<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $kepala = [1, 3, 5, 7, 9];
        $wakil = [2, 4, 6, 8, 10];
        $kebersihan = [11, 12, 13, 14, 15, 16, 17, 18, 19, 20];
        $keamanan = [21, 22, 23, 24, 25, 26, 27, 28, 29, 30];
        $keserasian = [31, 32, 33, 34, 35, 36, 37, 38, 39, 40];
        $kontrol = [41, 42, 43, 44, 45, 46, 47, 48, 49, 50];
        $administrasi = [51, 52, 53, 54, 55, 56, 57, 58, 59, 60];

        for ($i = 0; $i < count($kepala); $i++) {
            for ($j = 0; $j < 6; $j++) {
                DB::table('schedules')->insert([
                    'hari' => $hari[$j + 1],
                    'idPegawai' => $kepala[$i],
                    'idShift' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        for ($i = 0; $i < count($wakil); $i++) {
            for ($j = 1; $j < 7; $j++) {
                DB::table('schedules')->insert([
                    'hari' => $hari[$j],
                    'idPegawai' => $wakil[$i],
                    'idShift' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        for ($j = 0; $j < 14; $j++) {
            for ($k = 1; $k <= 3; $k++) {
                $day = rand(0, 6);
                $p = rand(0, count($keamanan) - 1);
                DB::table('schedules')->insert([
                    'hari' => $hari[$day],
                    'idPegawai' => $keamanan[$p],
                    'idShift' => $k,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        for ($j = 0; $j < 14; $j++) {
            for ($k = 1; $k <= 3; $k++) {
                $day = rand(0, 6);
                $p = rand(0, count($kebersihan) - 1);
                DB::table('schedules')->insert([
                    'hari' => $hari[$day],
                    'idPegawai' => $kebersihan[$p],
                    'idShift' => $k,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        for ($j = 0; $j < 14; $j++) {
            for ($k = 1; $k <= 3; $k++) {
                $day = rand(0, 6);
                $p = rand(0, count($keserasian) - 1);
                DB::table('schedules')->insert([
                    'hari' => $hari[$day],
                    'idPegawai' => $keserasian[$p],
                    'idShift' => $k,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        for ($j = 0; $j < 14; $j++) {
            for ($k = 1; $k <= 3; $k++) {
                $day = rand(0, 6);
                $p = rand(0, count($kontrol) - 1);
                DB::table('schedules')->insert([
                    'hari' => $hari[$day],
                    'idPegawai' => $kontrol[$p],
                    'idShift' => $k,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        for ($j = 0; $j < 14; $j++) {
            for ($k = 1; $k <= 3; $k++) {
                $day = rand(0, 6);
                $p = rand(0, count($administrasi) - 1);
                DB::table('schedules')->insert([
                    'hari' => $hari[$day],
                    'idPegawai' => $administrasi[$p],
                    'idShift' => $k,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        DB::delete('DELETE FROM schedules WHERE id NOT IN (SELECT MAX(id) FROM schedules GROUP BY hari, idPegawai)');
    }
}

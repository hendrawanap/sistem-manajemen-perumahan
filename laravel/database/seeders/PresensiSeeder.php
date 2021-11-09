<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = ['Tepat Waktu', 'Terlambat', 'Sakit', 'Izin'];
        date_default_timezone_set('Asia/Jakarta');
        $sakit = ['Demam', 'Pusing'];
        $izin = ['Ada acara', 'Urusan Keluarga'];
        $shift = [07, 15, 23];

        for ($i = 1; $i <= 44; $i++) {
            $temp = $status[rand(0, 1)];
            $s = $shift[rand(0, 2)];
            $day = rand(1, 7);
            if ($temp == 'Tepat Waktu' | $i % 2 == 0) {
                $temp = 'Tepat Waktu';
                $time = rand(0, 29);
                DB::table('presences')->insert([
                    'waktuPresensi' => date("Y-m-0$day $s:$time:s"),
                    'status' => $temp,
                    'idPegawai' => $i,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            } elseif ($temp == 'Terlambat') {
                $time = rand(31, 60);
                DB::table('presences')->insert([
                    'waktuPresensi' => date("Y-m-0$day $s:$time:s"),
                    'status' => $temp,
                    'idPegawai' => $i,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        for ($i = 45; $i <= 60; $i++) {
            $ket = $status[rand(2, 3)];
            $day = rand(1, 7);
            if ($ket == 'Sakit') {
                DB::table('presences')->insert([
                    'waktuPresensi' => date("Y-m-0$day 00:00:00"),
                    'status' => $ket,
                    'perizinan' => $sakit[rand(0, 1)],
                    'idPegawai' => $i,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            } else {
                DB::table('presences')->insert([
                    'waktuPresensi' => date("Y-m-0$day 00:00:00"),
                    'status' => $ket,
                    'perizinan' => $izin[rand(0, 1)],
                    'idPegawai' => $i,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('Asia/Jakarta');

        DB::table('shifts')->insert([
            'waktuMulai' => '07:00:00',
            'waktuSelesai' => '14:59:59',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('shifts')->insert([
            'waktuMulai' => '15:00:00',
            'waktuSelesai' => '23:59:59',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('shifts')->insert([
            'waktuMulai' => '00:00:00',
            'waktuSelesai' => '06:59:59',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

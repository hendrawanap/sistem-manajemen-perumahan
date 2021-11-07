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
        DB::table('shifts')->insert([
            'waktuMulai' => '07:00:00',
            'waktuSelesai' => '14:59:59',
        ]);
        DB::table('shifts')->insert([
            'waktuMulai' => '15:00:00',
            'waktuSelesai' => '23:59:59',
        ]);
        DB::table('shifts')->insert([
            'waktuMulai' => '00:00:00',
            'waktuSelesai' => '06:59:59',
        ]);
    }
}

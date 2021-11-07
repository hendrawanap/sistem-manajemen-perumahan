<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    public function getAllPresensi(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $presensi =
            DB::table('presences')
            ->where(DB::raw("DATE('$tanggal')"))
            ->get();

        return response()->json($presensi);
    }
}

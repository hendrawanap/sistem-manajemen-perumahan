<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;

class PerizinanController extends Controller
{
    public function addPerizinan(Request $request) {
        $presensi = new Presensi();
        $presensi->idPegawai = $request->input('idPegawai');
        $presensi->status = $request->input('tipePerizinan');
        $presensi->perizinan = $request->input('alasan');
        $presensi->waktuPresensi = $request->input('tanggalIzin');
        $presensi->save();

        return response()->json(['status'=>'success']);
    }

    public function getAllPerizinan()
    {
        $perizinan = Presensi::where('status','Izin')
                        ->orWhere('status', 'Sakit')
                        ->join('employees', 'employees.id', '=', 'presences.idPegawai')
                        ->select('presences.*', 'employees.nama')
                        ->get();
        
        return response()->json($perizinan);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function getAllJadwal($divisi) {
        $pegawai = Pegawai::select('id')->where('divisi', $divisi)->get();
        $allJadwal = Jadwal::whereIn('idPegawai', $pegawai)->get();

        return response()->json($allJadwal);
    }

    public function setJadwal(Request $request) {
        $jadwal = Jadwal::find($request->input('id'));
        $jadwal->hari = $request->input('hari');
        $jadwal->idPegawai = $request->input('idPegawai');
        $jadwal->idShift = $request->input('idShift');
        $jadwal->save();

        return response()->json(['status'=>'success']);
    }

    public function deleteJadwal(Request $request) {
        $jadwal = Jadwal::find($request->input('id'));
        $jadwal->delete();

        return response()->json(['status'=>'success']);
    }

    public function addJadwal(Request $request) {
        $jadwal = new Jadwal();
        $jadwal->hari = $request->input('hari');
        $jadwal->idPegawai = $request->input('idPegawai');
        $jadwal->idShift = $request->input('idShift');
        $jadwal->save();

        return response()->json(['status'=>'success']);
    }
}

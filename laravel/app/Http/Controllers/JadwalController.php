<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function getAllJadwal($divisi) {
        $pegawai = Pegawai::select('id')->where('divisi', $divisi)->get();
        $allJadwal = Jadwal::whereIn('idPegawai', $pegawai)
                        ->join('employees','employees.id','=','schedules.idPegawai')
                        ->select('schedules.*', 'employees.nama', 'employees.divisi')
                        ->get();

        return response()->json($allJadwal);
    }

    public function setJadwal(Request $request) {
        $jadwal = Jadwal::find($request->input('id'));
        $jadwal->hari = $request->input('hari');
        $jadwal->idPegawai = $request->input('idPegawai');
        $jadwal->idShift = $request->input('idShift');
        $jadwal->save();

        return response()->json(['message' => 'Berhasil mengatur jadwal']);
    }

    public function deleteJadwal($id) {
        $jadwal = Jadwal::find($id);
        $jadwal->delete();

        return response()->json(['message' => 'Berhasil menghapus jadwal']);
    }

    public function addJadwal(Request $request) {
        $jadwal = new Jadwal();
        $jadwal->hari = $request->input('hari');
        $jadwal->idPegawai = $request->input('idPegawai');
        $jadwal->idShift = $request->input('idShift');
        $jadwal->save();

        return response()->json(['message' => 'Berhasil menambah jadwal']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Pegawai;
use App\Models\Presensi;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    public function getAllPresensi($tanggal)
    {
        $presensi = Presensi::where('waktuPresensi', '>=', $tanggal . " 00:00:00")
                        ->where('waktuPresensi', '<=', $tanggal . " 23:59:59")
                        ->join('employees', 'employees.id', '=', 'presences.idPegawai')
                        ->select('presences.*', 'employees.nama')
                        ->orderBy('waktuPresensi')
                        ->get();

        return response()->json($presensi);
    }

    public function getPresensiAlpha($tanggal)
    {
        $daysEnum = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $day = $daysEnum[(int) date('w', strtotime($tanggal))];
        $allPegawai = Jadwal::where('hari',$day)
                            ->join('employees', 'employees.id', '=', 'schedules.idPegawai')
                            ->select('employees.id', 'employees.nama')
                            ->get();
        $pegawaiPresensi = Presensi::where('waktuPresensi', '>=', $tanggal . " 00:00:00")
                            ->where('waktuPresensi', '<=', $tanggal . " 23:59:59")
                            ->join('employees', 'employees.id', '=', 'presences.idPegawai')
                            ->select('employees.id')
                            ->get();
        $idPegawaiPresensi = array_map(function($pegawai) {
            return $pegawai['id'];
        }, $pegawaiPresensi->toArray());

        $pegawaiAlpha = array();
        foreach ($allPegawai as $pegawai) {
            if (!in_array($pegawai->id, $idPegawaiPresensi)) {
                array_push($pegawaiAlpha, $pegawai);
            }
        }

        return response()->json($pegawaiAlpha);
    }

    public function cekPresensi(Request $request)
    {
        $pegawai = Pegawai::find($request->input('idPegawai'));
        if ($pegawai) {
            $jadwal = Jadwal::whereIn('idPegawai', [$pegawai->id])
                ->join('employees', 'employees.id', '=', 'schedules.idPegawai')
                ->select('schedules.*', 'employees.nama', 'employees.divisi')
                ->get()[0];
            $daysEnum = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            $waktuPresensi = explode('T', $request->input('waktuPresensi'));
            $day = (int) date('w', strtotime($waktuPresensi[0]));
            if ($jadwal) {
                $time = strtotime($waktuPresensi[1]);
                $shift = Shift::find($jadwal->idShift);
                $isValid = ($jadwal->hari == $daysEnum[$day]) && ($time - strtotime($shift->waktuMulai)) > 0 && ($time - strtotime($shift->waktuSelesai)) < 0;
                if ($isValid) {
                    $sudahPresensi = Presensi::where('idPegawai', $pegawai->id)
                        ->where('waktuPresensi', '>=', $waktuPresensi[0] . ' ' . '00:00:00')
                        ->where('waktuPresensi', '<=', $waktuPresensi[0] . ' ' . '23:59:59')
                        ->get();
                    if (count($sudahPresensi) > 0) {
                        return response()->json(['message' => "Anda Sudah Presensi"]);
                    }
                    $isTerlambat = ($time - strtotime($shift->waktuMulai)) / 60 > 30;
                    $presensi = new Presensi();
                    $presensi->waktuPresensi = str_replace('T', ' ', $request->input('waktuPresensi'));
                    $presensi->status = $isTerlambat ? 'Terlambat' : 'Tepat Waktu';
                    $presensi->idPegawai = $jadwal->idPegawai;
                    $presensi->save();
                    return response()->json(['message' => 'Berhasil mencatat presensi']);
                }
                return response()->json(['message' => 'Jadwal tidak ditemukan']);
            }
            return response()->json(['message' => 'Jadwal tidak ditemukan']);
        }
        return response()->json(['message' => 'Pegawai tidak ditemukan']);
    }
}

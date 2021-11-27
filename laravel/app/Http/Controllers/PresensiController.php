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
    public function getAllPresensi(Request $request)
    {
        if ($request->query('alpha') == 'true') {
            $presensi = $this->getPresensiAlpha($request->query('tanggal'));
        } else {
            $presensi = Presensi::where('waktuPresensi', '>=', $request->query('tanggal') . " 00:00:00")
                            ->where('waktuPresensi', '<=', $request->query('tanggal') . " 23:59:59")
                            ->join('employees', 'employees.id', '=', 'presences.idPegawai')
                            ->select('presences.*', 'employees.nama')
                            ->orderBy('waktuPresensi')
                            ->get();
        }

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

        return $pegawaiAlpha;
    }

    public function cekPresensi(Request $request)
    {
        $pegawai = Pegawai::find($request->input('idPegawai')); // 1
        $message = "";
        if (!$pegawai) { // 2
            $message = 'Pegawai tidak ditemukan'; // 3
        } else {
            $daysEnum = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; // 4
            $splitWaktu = explode('T', $request->input('waktuPresensi'));
            $tanggalPresensi = $splitWaktu[0];
            $waktuPresensi = strtotime($splitWaktu[1]);
            $dayIndex = (int) date('w', strtotime($tanggalPresensi));
            $day = $daysEnum[$dayIndex];
            $jadwal = Jadwal::where('idPegawai', $pegawai->id)
                ->where('hari', $day)
                ->join('employees', 'employees.id', '=', 'schedules.idPegawai')
                ->select('schedules.*', 'employees.nama', 'employees.divisi')
                ->get();

            if ($jadwal->count() == 0) { // 5
                $message = 'Pegawai tidak memiliki jadwal pada hari ini'; // 6
            } else {
                $jadwal = $jadwal[0]; // 7
                $shift = Shift::find($jadwal->idShift);
                $diffWktMulai = $waktuPresensi - strtotime($shift->waktuMulai);
                $diffWktSelesai = $waktuPresensi - strtotime($shift->waktuSelesai);
                if (!($diffWktMulai >= 0 && $diffWktSelesai <= 0)) { // 8,9
                    $message = 'Pegawai tidak memiliki jadwal pada shift ini'; // 10
                } else {
                    $sudahPresensi = Presensi::where('idPegawai', $pegawai->id) // 11
                        ->where('waktuPresensi', '>=', $tanggalPresensi . ' ' . '00:00:00')
                        ->where('waktuPresensi', '<=', $tanggalPresensi . ' ' . '23:59:59')
                        ->get();
                    if ($sudahPresensi->count() > 0) { // 12
                        $message = "Pegawai sudah presensi"; // 13
                    } else { // 14
                        $isTerlambat = ($diffWktMulai / 60) > 30;
                        $presensi = new Presensi();
                        $presensi->waktuPresensi = str_replace('T', ' ', $request->input('waktuPresensi'));
                        $presensi->status = $isTerlambat ? 'Terlambat' : 'Tepat Waktu';
                        $presensi->idPegawai = $jadwal->idPegawai;
                        $presensi->save();
                        $message = 'Berhasil mencatat presensi';
                    }
                }
            }
        }

        return response()->json(['message' => $message]); // 15
    }
}

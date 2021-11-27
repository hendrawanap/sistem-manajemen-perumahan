<?php

namespace App\Http\Controllers;

use App\Models\KK;
use App\Models\Pembayaran;
use App\Models\Presensi;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function getLaporanPresensi(Request $request) {
        $tahun = $request->query('tahun');
        $bulan = $request->query('bulan');
        if ($bulan < 10) {
            $bulan = '0' + (int) $bulan;
        }
        $tanggalAwal = "$tahun-$bulan-01";
        $akhirBulan = date('t', strtotime($tanggalAwal));
        $tanggalAwal = $tanggalAwal . ' 00:00:00';
        $tanggalAkhir = "$tahun-$bulan-$akhirBulan 23:59:59";
        $presensi = Presensi::where('waktuPresensi', '>=', $tanggalAwal)
                            ->where('waktuPresensi', '<=', $tanggalAkhir)
                            ->join('employees', 'employees.id', '=', 'presences.idPegawai')
                            ->select('presences.*', 'employees.nama')
                            ->orderBy('waktuPresensi')
                            ->get();
        $presensi->where('waktuPresensi', '>=', "$tahun-$bulan-01" . " 00:00:00")
                    ->where('waktuPresensi', '<=', "$tahun-$bulan-01" . " 23:59:59")
                    ->whereIn('status',['Tepat Waktu', 'Terlambat'])->toArray();
        $output = array();
        
        $presensiController = new PresensiController();
        
        for ($i=1; $i <= $akhirBulan; $i++) {
            $tanggal = $i;
            if ($i < 10){
                $tanggal = '0' . $i;
            }
            $semua = $presensi->where('waktuPresensi', '>=', "$tahun-$bulan-$tanggal" . " 00:00:00")
                        ->where('waktuPresensi', '<=', "$tahun-$bulan-$tanggal" . " 23:59:59");
            $hadir = $semua->whereIn('status',['Tepat Waktu', 'Terlambat'])->count();
            $alpha = count($presensiController->getPresensiAlpha("$tahun-$bulan-$tanggal"));
            $semua = $semua->count() + $alpha;

            array_push($output, [
                'tanggal' => "$tahun-$bulan-$tanggal",
                'presensi' => $hadir . '/' . $semua
            ]);
        }
        return response()->json($output);
    }

    public function getLaporanTagihan(Request $request) {
        $tahun = $request->query('tahun');
        $bulan = $request->query('bulan');
        $tanggalAwal = "$tahun-$bulan-01";
        $akhirBulan = date('t', strtotime($tanggalAwal));
        $tanggalAkhir = "$tahun-$bulan-$akhirBulan";
        $jumlahKK = KK::all()->count();
        $tagihan = Tagihan::whereBetween('tanggalTagihan', [$tanggalAwal, $tanggalAkhir])
                            ->take(1)
                            ->get()
                            ->toArray();
        if ($tagihan) {
            $sudah = Pembayaran::where('idTagihan',$tagihan[0]['id'])
                        ->join('families', 'families.id', '=', 'payments.idKK')
                        ->select('payments.id', 'payments.tanggalBayar', 'families.nomorKK', 'families.kepalaKeluarga')
                        ->get()
                        ->count();
            return response()->json(['jumlahKK' => $jumlahKK, 'sudah' => $sudah, 'belum' => $jumlahKK - $sudah, 'tagihan' => $tagihan[0]]);
        } else {
            return response()->json(['message' => 'Tidak Ada Tagihan']);
        }
    }
}

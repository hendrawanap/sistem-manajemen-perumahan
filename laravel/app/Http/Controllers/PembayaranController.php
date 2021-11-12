<?php

namespace App\Http\Controllers;

use App\Models\KK;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function getAllPembayaran(Request $request)
    {
        if ($request->query('belum') == 'true') {
            $allPembayaran = $this->getBelumDibayar($request->query('tagihan'));
        } else {
            $allPembayaran = Pembayaran::where('idTagihan',$request->query('tagihan'))
                            ->join('families', 'families.id', '=', 'payments.idKK')
                            ->select('payments.id', 'payments.tanggalBayar', 'families.nomorKK', 'families.kepalaKeluarga')
                            ->get();
        }

        return response()->json($allPembayaran);
    }

    public function getPembayaran($id)
    {
        $pembayaran = Pembayaran::where('payments.id',$id)
                        ->join('families', 'families.id', '=', 'payments.idKK')
                        ->join('bills', 'bills.id', '=', 'payments.idTagihan')
                        ->select('payments.*', 'families.nomorKK', 'bills.rincian')
                        ->get()[0];

        return response()->json($pembayaran);
    }

    public function getBelumDibayar($idTagihan)
    {
        $kkSudahBayar = array_map(function($val){
            return $val['idKK'];
        }, Pembayaran::where('idTagihan', $idTagihan)->select('idKK')->get()->toArray());

        $allKK = KK::whereNotIn('id', $kkSudahBayar)->select('id','nomorKK', 'kepalaKeluarga')->get();
        
        return $allKK;
    }

    public function addPembayaran(Request $request)
    {
        $pembayaran = new Pembayaran();
        $pembayaran->namaPembayar = $request->input('namaPembayar');
        $pembayaran->tanggalBayar = $request->input('tanggalBayar');
        $pembayaran->idKK = $request->input('idKK');
        $pembayaran->idTagihan = $request->input('idTagihan');
        $pembayaran->save();

        return response()->json(['message' => 'Berhasil mencatat pembayaran']);
    }
}

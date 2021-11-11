<?php

namespace App\Http\Controllers;

use App\Models\KK;
use Illuminate\Http\Request;

class KKController extends Controller
{
    public function getAllKK()
    {
        $allKK = KK::all();

        return response()->json($allKK);
    }

    public function getKK($id)
    {
        $KK = KK::find($id);

        return response()->json($KK);
    }

    public function setKK(Request $request, $id)
    {
        $KK = KK::find($id);
        $KK->nomorKK = $request->input('nomorKK');
        $KK->alamat = $request->input('alamat');
        $KK->kepalaKeluarga = $request->input('kepalaKeluarga');
        $KK->save();

        return response()->json(['message' => 'Berhasil mengubah data KK']);
    }

    public function deleteKK($id)
    {
        $KK = KK::find($id);
        $KK->delete();

        return response()->json(['message' => 'Berhasil menghapus data KK']);
    }

    public function addKK(Request $request)
    {
        $KK = new KK();
        $KK->nomorKK = $request->input('nomorKK');
        $KK->alamat = $request->input('alamat');
        $KK->kepalaKeluarga = $request->input('kepalaKeluarga');
        $KK->save();

        return response()->json(['message' => 'Berhasil menambah data KK']);
    }
}

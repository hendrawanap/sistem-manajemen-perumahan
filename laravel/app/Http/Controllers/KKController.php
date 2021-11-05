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
        $KK = KK::where('id', $id)->get();

        return response()->json($KK);
    }

    public function setKK(Request $request, $id)
    {
        $KK = KK::find($id);
        $KK->nomorKK = $request->input('nomorKK');
        $KK->alamat = $request->input('alamat');
        $KK->kepalaKeluarga = $request->input('kepalaKeluarga');
        $KK->save();

        return response()->json(['status' => 'success']);
    }

    public function deleteKK($id)
    {
        $KK = KK::find($id);
        $KK->delete();

        return response()->json(['status' => 'success']);
    }

    public function addKK(Request $request)
    {
        $KK = new KK();
        $KK->nomorKK = $request->input('nomorKK');
        $KK->alamat = $request->input('alamat');
        $KK->kepalaKeluarga = $request->input('kepalaKeluarga');
        $KK->save();

        return response()->json(['status' => 'success']);
    }
}

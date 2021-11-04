<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function getAllFasilitas()
    {
        $allFasilitas = Fasilitas::all();
    }

    public function getFasilitas($id)
    {
        $fasilitas = Fasilitas::where('id', $id)->get();
        return response()->json($fasilitas);
    }

    public function setFasilitas(Request $request, $id)
    {
        $fasilitas = Fasilitas::find($id);
        $fasilitas->namaFasilitas = $request->input('namaFasilitas');
        $fasilitas->kondisi = $request->input('kondisi');
        $fasilitas->informasi = $request->input('informasi');
        $fasilitas->save();

        return response()->json(['status' => 'success']);
    }

    public function deleteFasilitas($id)
    {
        $fasilitas = Fasilitas::find($id);
        $fasilitas->delete();

        return response()->json(['status' => 'success']);
    }

    public function addFasilitas(Request $request)
    {
        $fasilitas = new Fasilitas();
        $fasilitas->namaFasilitas = $request->input('namaFasilitas');
        $fasilitas->kondisi = $request->input('kondisi');
        $fasilitas->informasi = $request->input('informasi');
        $fasilitas->save();

        return response()->json(['status' => 'success']);
    }
}
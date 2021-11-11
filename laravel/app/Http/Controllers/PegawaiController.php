<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function getAllPegawai() {
        $allPegawai = Pegawai::all();

        return response()->json($allPegawai);
    }

    public function getPegawai($id) {
        $pegawai = Pegawai::where('id', $id)->get();

        return response()->json($pegawai);
    }

    public function getPegawaiByDivisi($divisi) {
        $pegawai = Pegawai::where('divisi', $divisi)->get();

        return response()->json($pegawai);
    }

    public function setPegawai(Request $request, $id) {
        $pegawai = Pegawai::find($id);
        $pegawai->nama = $request->input('nama');
        $pegawai->gender = $request->input('gender');
        $pegawai->alamat = $request->input('alamat');
        $pegawai->tanggalMasuk = $request->input('tanggalMasuk');
        $pegawai->divisi = $request->input('divisi');
        $pegawai->jabatan = $request->input('jabatan');
        $pegawai->save();

        return response()->json(['message' => 'Berhasil mengubah data pegawai']);
    }

    public function deletePegawai($id) {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();

        return response()->json(['message' => 'Berhasil menghapus data pegawai']);
    }

    public function addPegawai(Request $request) {
        $pegawai = new Pegawai();
        $pegawai->nama = $request->input('nama');
        $pegawai->gender = $request->input('gender');
        $pegawai->alamat = $request->input('alamat');
        $pegawai->tanggalMasuk = $request->input('tanggalMasuk');
        $pegawai->divisi = $request->input('divisi');
        $pegawai->jabatan = $request->input('jabatan');
        $pegawai->save();

        return response()->json(['message' => 'Berhasil menambah data pegawai']);
    }
}

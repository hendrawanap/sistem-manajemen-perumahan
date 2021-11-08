<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public static function getAllTagihan()
    {
        $allTagihan = Tagihan::all();

        return response()->json($allTagihan);
    }
    
    public static function addTagihan(Request $request)
    {
        $user = auth()->user();
        $tagihan = new Tagihan();
        $tagihan->namaTagihan = $request->input('namaTagihan');
        $tagihan->rincian = $request->input('rincian');
        $tagihan->user_id = $user->id;
        $tagihan->tanggalTagihan = $request->input('tanggalTagihan');
        $tagihan->save();

        return response()->json(['status' => 'success']);
    }
}

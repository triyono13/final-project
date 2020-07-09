<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KomentarPertanyaan;
use App\KomentarJawaban;
use Auth;

class KomentarController extends Controller
{
    public function pertanyaan(Request $request, $id)
    {
        $this->validate($request, [
            'komentar' => 'required'
        ]);
        
        $komentar = KomentarPertanyaan::create([
            'isi_komentar' => $request->komentar,
            'pertanyaans_id' => $id,
            'users_id' => Auth::id()

        ]);
        return redirect()->back()->with('success', 'Pertanyaan berhasil diposting');
    }
    public function jawaban(Request $request, $id)
    {
        $this->validate($request, [
            'komentar' => 'required'
        ]);
        
        $komentar = KomentarJawaban::create([
            'isi_komentar' => $request->komentar,
            'jawabans_id' => $id,
            'users_id' => Auth::id()

        ]);
        return redirect()->back()->with('success', 'Pertanyaan berhasil diposting');
    }
}

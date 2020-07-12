<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KomentarPertanyaan;
use App\KomentarJawaban;
use App\Jawaban;
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
        alert()->success('Success','Komentar Berhasil Diposting');
        return redirect()->back();
    }
    public function jawabanedit($id)
    {
        $jawaban = Jawaban::find($id);
        return view ('komentar.create', compact('jawaban'));
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
        alert()->success('Success','Komentar Berhasil Diposting');
        return redirect()->back();
    }
}

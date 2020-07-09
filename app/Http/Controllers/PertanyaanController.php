<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertanyaan;
use App\User;
use App\Jawaban;
use App\KomentarPertanyaan;
use App\KomentarJawaban;
use DB;
use Auth;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pertanyaan = Pertanyaan::latest()->where('users_id', 'like','%'.Auth::id().'%')->paginate(10);
        return view ('index', compact('pertanyaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('pertanyaan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'isi' => 'required'
        ]);
        
        $pertanyaan = Pertanyaan::create([
            'judul' => $request->judul,
            'isi_pertanyaan' => $request->isi,
            'users_id' => Auth::id()

        ]);
        return redirect()->back()->with('success', 'Pertanyaan berhasil diposting');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pertanyaan = Pertanyaan::findorfail($id);
        $jawaban = Jawaban::all();
        $komentar_pertanyaan = DB::table('komentar_pertanyaans')->join('pertanyaans', 'pertanyaans.id', '=', 'komentar_pertanyaans.pertanyaans_id')->where('komentar_pertanyaans.pertanyaans_id', 'like','%'.$id.'%')->get();
        //$komentar_jawaban = DB::table('komentar_jawabans')->join('jawabans', 'jawabans.id', '=', 'komentar_jawabans.jawabans_id')->where('komentar_jawabans.jawabans_id', 'like','%'.$id.'%')->get();
        $hitung = $jawaban->count();
        return view ('jawaban.index', compact('pertanyaan', 'jawaban', 'hitung', 'komentar_pertanyaan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

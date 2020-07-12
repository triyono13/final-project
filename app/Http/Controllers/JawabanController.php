<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertanyaan;
use App\Jawaban;
use App\User;
use DB;
use Auth;

class JawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // $pertanyaan = Pertanyaan::findorfail($id);
        // $jawaban = DB::table('jawabans')->join('pertanyaans', 'pertanyaans.id', '=', 'jawabans.pertanyaans_id')->select('jawabans.jawaban')->where('jawabans.pertanyaans_id', 'like','%'.$id.'%')->get();
        // $hitung = $jawaban->count();
        // return view ('jawaban.index', compact('pertanyaan', 'jawaban', 'hitung'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $this->validate($request, [
            'jawaban' => 'required'
        ]);
        
        $jawaban = Jawaban::create([
            'jawaban' => $request->jawaban,
            'pertanyaans_id' => $id,
            'users_id' => Auth::id()

        ]);
        alert()->success('Success','Jawaban Berhasil Diposting');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function verifikasi($Id, Request $request)
    {
        $poin = "15";
        $verif = "1";
        $verifikasi_data = [
            'status' => $verif
        ];
        $reputasi_poin = [
            'reputasi' => $poin
        ];

        User::whereId($request->user)->update($reputasi_poin);
        Jawaban::whereId($Id)->update($verifikasi_data);
        alert()->success('Success','Jawaban Telah ditandai');
        return redirect()->back();
    }
}

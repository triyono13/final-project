<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertanyaan;
use App\User;
use App\Jawaban;
use App\KomentarPertanyaan;
use App\KomentarJawaban;
use App\VotePertanyaan;
use App\VoteJawaban;
use App\Tag;
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
        $tag = Tag::all();
        $pertanyaan = Pertanyaan::latest()->where('users_id', 'like','%'.Auth::id().'%')->paginate(10);
        return view ('pertanyaan.index', compact('pertanyaan', 'tag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag = Tag::all();
        return view ('pertanyaan.create', compact('tag'));
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

        $pertanyaan->tags()->attach($request->tags);
        alert()->success('Success','Pertanyaan Berhasil Diposting');
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
        $tags = Tag::all();
        $angka = "1";
        $pertanyaan = Pertanyaan::findorfail($id);
        $jawaban =  Jawaban::all();
        $verif = DB::table('jawabans')->where('jawabans.pertanyaans_id', $id)->where('jawabans.status', $angka)->get();
        $komentar_pertanyaan = DB::table('komentarpertanyaans')->join('pertanyaans', 'pertanyaans.id', '=', 'komentarpertanyaans.pertanyaans_id')->where('komentarpertanyaans.pertanyaans_id', $id)->get();
        $komentar_jawaban = KomentarJawaban::all();
        $hitungjawaban = DB::table('jawabans')->join('pertanyaans', 'pertanyaans.id', '=', 'jawabans.pertanyaans_id')->where('jawabans.pertanyaans_id', $id)->get();
        $hitung = $hitungjawaban->count();
        $vote_pertanyaan = DB::table('vote_pertanyaan')->join('pertanyaans', 'pertanyaans.id', '=', 'vote_pertanyaan.pertanyaans_id')->where('vote_pertanyaan.pertanyaans_id', $id)->where('vote_pertanyaan.vote', 'up')->get();
        $vote_jawaban = VoteJawaban::where('pertanyaans_id', '=', $id)->get();
        $hitung_vote_jawaban = $vote_jawaban->count();
        $hitung_vote_pertanyaan = $vote_pertanyaan->count();
        $komentar_pertanyaan = DB::table('komentarpertanyaans')->join('pertanyaans', 'pertanyaans.id', '=', 'komentarpertanyaans.pertanyaans_id')->where('komentarpertanyaans.pertanyaans_id', $id)->get();
        return view ('jawaban.index', compact('pertanyaan', 'jawaban', 'hitung', 'komentar_pertanyaan', 'komentar_jawaban', 'verif',  'hitung_vote_pertanyaan', 'hitung_vote_jawaban', 'vote_jawaban', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::all();
        $pertanyaan = Pertanyaan::find($id);
        return view ('pertanyaan.edit', compact('tag', 'pertanyaan'));
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
        $pertanyaan_data = [
            'judul' => $request->judul,
            'isi_pertanyaan' => $request->isi
        ];
        Pertanyaan::whereId($id)->update($pertanyaan_data);
        alert()->success('Success','Pertanyaan Berhasil DiUpdate');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pertanyaan = Pertanyaan::findorfail($id);
        $pertanyaan->delete();
        alert()->success('Success','Pertanyaan Berhasil Dihapus');
        return redirect()->back();
    }
}

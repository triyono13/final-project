<?php

namespace App\Http\Controllers;

use Alert;
use Illuminate\Http\Request;
use App\VotePertanyaan;
use App\VoteJawaban;
use App\User;
use Auth;

class VoteController extends Controller
{
    public function votepertanyaanup(Request $request, $id)
    {
        if (VotePertanyaan::where('users_id', '=', Auth::id())->where('pertanyaans_id', '=', $id)->exists()) {
            alert()->error('Error','Anda Telah Melakukan Voting !');
            return redirect()->back();
        }
        else{
            $get_poin = User::find($request->user);
            $vote = "up";
            $poin = "10";
            $vote = VotePertanyaan::create([
                'pertanyaans_id' => $id,
                'users_id' => Auth::id(),
                'vote' => $vote

            ]);
            $reputasi_poin = [
                'reputasi' => $poin + $get_poin->reputasi
            ];
            
            User::whereId($request->user)->update($reputasi_poin);
            Alert::alert('Success', 'Anda Berhasil Melakukan Up-Vote');
            return redirect()->back();
        }
    }
    public function votepertanyaandown(Request $request, $id)
    {
        $get_poin = User::find($request->user);
        if (VotePertanyaan::where('users_id', '=', Auth::id())->where('pertanyaans_id', '=', $id)->exists()) {
            alert()->error('Error','Anda Telah Melakukan Voting !');
            return redirect()->back();
        }
        else{
            $vote = "down";
            $poin = "1";
            $vote = VotePertanyaan::create([
                'pertanyaans_id' => $id,
                'users_id' => Auth::id(),
                'vote' => $vote

            ]);
            $reputasi_poin = [
                'reputasi' =>  $get_poin->reputasi - $poin
            ];

            User::whereId($request->user)->update($reputasi_poin);
            alert()->success('Success','Anda Berhasil Melakukan Down-Vote');
            return redirect()->back();
        }
    }

    public function votejawabanup(Request $request, $id)
    {
        if (VoteJawaban::where('users_id', '=', Auth::id())->where('jawabans_id', '=', $id)->exists()) {
            alert()->error('Error','Anda Telah Melakukan Voting !');
            return redirect()->back();
        }
        else{
            $get_poin = User::find($request->user);
            $vote = "up";
            $poin = "10";
            $vote = VoteJawaban::create([
                'jawabans_id' => $id,
                'users_id' => Auth::id(),
                'pertanyaans_id' => $request->id_pertanyaan,
                'vote' => $vote

            ]);
            $reputasi_poin = [
                'reputasi' => $get_poin->reputasi + $poin
            ];

            User::whereId($request->user)->update($reputasi_poin);
            alert()->success('Success','Anda Berhasil Melakukan Up-Vote');
            return redirect()->back();
        }
    }
    public function votejawabandown(Request $request, $id)
    {
        $get_poin = User::find($request->user);
        if (VoteJawaban::where('users_id', '=', Auth::id())->where('jawabans_id', '=', $id)->exists()) {
            alert()->error('Error','Anda Telah Melakukan Voting !');
            return redirect()->back();
        }
        else{
            $vote = "up";
            $poin = "1";
            $vote = VoteJawaban::create([
                'jawabans_id' => $id,
                'users_id' => Auth::id(),
                'pertanyaans_id' => $request->id_pertanyaan,
                'vote' => $vote

            ]);
            $reputasi_poin = [
                'reputasi' => $get_poin->reputasi - $poin
            ];

            User::whereId($request->user)->update($reputasi_poin);
            alert()->success('Success','Anda Berhasil Melakukan Down-Vote');
            return redirect()->back();
        }
    }
}

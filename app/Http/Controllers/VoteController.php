<?php

namespace App\Http\Controllers;

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
            return redirect()->back()->with('success', 'Anda Sudah Melakukan Voting Sebelumnya');
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
            return redirect()->back()->with('success', 'Pertanyaan berhasil diposting');
        }
    }
    public function votepertanyaandown(Request $request, $id)
    {
        if (VotePertanyaan::where('users_id', '=', Auth::id())->where('pertanyaans_id', '=', $id)->exists()) {
            return redirect()->back()->with('success', 'Anda Sudah Melakukan Voting Sebelumnya');
        }
        else{
            $get_poin = User::find($request->user);
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
            return redirect()->back()->with('success', 'Pertanyaan berhasil diposting');
        }
    }

    public function votejawabanup(Request $request, $id)
    {
        if (VoteJawaban::where('users_id', '=', Auth::id())->where('jawabans_id', '=', $id)->exists()) {
            return redirect()->back()->with('success', 'Anda Sudah Melakukan Voting Sebelumnya');
        }
        else{
            $get_poin = User::find($request->user);
            $vote = "up";
            $poin = "10";
            $vote = VoteJawaban::create([
                'jawabans_id' => $id,
                'users_id' => Auth::id(),
                'vote' => $vote

            ]);
            $reputasi_poin = [
                'reputasi' => $get_poin->reputasi + $poin
            ];

            User::whereId($request->user)->update($reputasi_poin);
            return redirect()->back()->with('success', 'Pertanyaan berhasil diposting');
        }
    }
    public function votejawabandown(Request $request, $id)
    {
        dd($request->user);
    }
}

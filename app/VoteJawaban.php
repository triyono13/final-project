<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteJawaban extends Model
{
    protected $table = ('vote_jawaban');
    protected $fillable = ['jawabans_id', 'users_id', 'vote', 'pertanyaans_id'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VotePertanyaan extends Model
{
    protected $fillable = ['pertanyaans_id', 'users_id', 'vote'];
    protected $table = ('vote_pertanyaan');
}

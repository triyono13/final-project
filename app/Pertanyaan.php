<?php

namespace App;
use App\Jawaban;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $fillable = ['judul','isi_pertanyaan','users_id'];
    
    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

}

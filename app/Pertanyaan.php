<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $fillable = ['judul','isi_pertanyaan','users_id'];
    
    public function users()
    {
        return $this->belongsTo('App\User');
    }
        public function pertanyaan()
    {
        return $this->belongsTo('App\Jawaban');
    }
    public function jawaban()
    {
        return $this->belongsTo('App\Jawaban');
    }
}

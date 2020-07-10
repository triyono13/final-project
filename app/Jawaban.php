<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $fillable = ['jawaban', 'pertanyaans_id', 'users_id'];

    public function komentars()
    {
        $table = 'komentarjawabans';
        return $this->belongsTo('App\KomentarJawaban');
    }

    public function pertanyaans()
    {
        return $this->belongsTo('App\Pertanyaan');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}

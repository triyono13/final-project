<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomentarJawaban extends Model
{
    protected $fillable = ['jawabans_id', 'users_id', 'isi_komentar'];
    protected $table = 'komentarjawabans';
    public function pertanyaans()
    {
        return $this->belongsTo('App\Pertanyaan');
    }
    public function jawabans()
    {
        return $this->belongsTo('App\Jawaban');
    }
}

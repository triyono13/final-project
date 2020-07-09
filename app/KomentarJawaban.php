<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomentarJawaban extends Model
{
    protected $fillable = ['jawabans_id', 'users_id', 'isi_komentar'];
    public function pertanyaan()
    {
        return $this->belongsTo('App\Pertanyaan');
    }
}

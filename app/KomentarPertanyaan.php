<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomentarPertanyaan extends Model
{
    protected $fillable = ['pertanyaans_id', 'users_id', 'isi_komentar'];
}

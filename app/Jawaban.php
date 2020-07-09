<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $fillable = ['jawaban', 'pertanyaans_id', 'users_id'];
    public function pertanyaan()
    {
        return $this->belongsTo('App\Pertanyaan');
    }

}

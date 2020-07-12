<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name','pertanyaans_id'];

    public function pertanyaans()
    {
        return $this->belongsToMany('App\Pertanyaan');
    }

}

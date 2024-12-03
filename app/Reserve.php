<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{    protected $fillable = ['num_affaire', 'periode_conservation','etat','caracteristiques'];

    public function affaire(){
        return $this->belongsTo('App\Affaire');
    }
}

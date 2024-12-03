<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Echantillon extends Model
{    protected $fillable = ['num_scelle','num_echantillon','datep','num_affaire', 'periode_conservation','etat','description', 'traite'];

    public function affaire(){
        return $this->belongsTo('App\Affaire');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class Couple extends Model
{
    protected $fillable = ['nni', 'nom', 'prenom', 'statut', 'sexe', 'employe_id', 'date_mariage', 'date_naissance'];
    
    public function getDateFormat(){
        return 'Y-m-d H:i:s.u';
    }
   // public $timestamps  = false;
    public function fromDateTime($value)
    {
         return Carbon::parse(parent::fromDateTime($value))->format('Y-d-m H:i:s');
    }

    public function employe(){
        return $this->belongsTo('App\Employe');
    }
}

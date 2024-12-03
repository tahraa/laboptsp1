<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class Couple extends Model
{
    protected $fillable = ['nni', 'nom', 'prenom', 'statut', 'sexe', 'employe_id', 'date_mariage', 'date_naissance', 'situation_civile', 'matricule', 'service', 'situation_civile', 'situation_de_famille', 'type', 'image'];
    protected $dateFormat = 'Y-d-m H:i:s';
    public function getDateFormat(){
        return 'Y-m-d H:i:s.v';
    }
    public $timestamps  = false;
    public function fromDateTime($value)
    {
         return Carbon::parse(parent::fromDateTime($value))->format('Y-m-d H:i:s');
    }

    public function employe(){
        return $this->belongsTo('App\Employe');
    }
    public function beneficier(){
        return $this->belongsTo('App\Beneficier');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class CoupleB extends Model
{
    protected $fillable = ['nni', 'nom', 'prenom', 'statut', 'sexe', 'beneficier_id', 'date_mariage', 'date_naissance', 'situation_civile', 'matricule', 'service', 'situation_civile', 'type', 'image'];
    protected $dateFormat = 'Y-d-m H:i:s';
    public function getDateFormat(){
        return 'Y-m-d H:i:s.v';
    }
    public $timestamps  = false;
    public function fromDateTime($value)
    {
         return Carbon::parse(parent::fromDateTime($value))->format('Y-m-d H:i:s');
    }


    public function beneficier(){
        return $this->belongsTo('App\Beneficier');
    }
}

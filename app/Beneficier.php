<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Beneficier extends Model
{
    protected $fillable = ['nni', 'nom', 'prenom', 'matricule', 'statut', 'sexe', 'updated_at', 'created_at', 'date_naissance', 'situation_civile', 'service','image','num_cnam','type', 'etablissement','delai','date_recrutement'];

    public function getDateFormat(){
        return 'Y-m-d H:i:s.v';
    }

    public static function findByMatricule(String $matricule){
        return Employe::where('matricule','=',$matricule);
    }

    public $timestamps  = false;
    public function fromDateTime($value)
    {
        // Only for MSSQL
        if(env('DB_CONNECTION') == 'sqlsrv'){
            return Carbon::parse(parent::fromDateTime($value))->format('Y-m-d H:i:s.v');
        }
        return $value;
    }

    public function couples(){
        return $this->hasMany('App\CoupleB');
    }
    public function enfants(){
        return $this->hasMany('App\EnfantB');
    }
}

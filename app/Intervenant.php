<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
class Intervenant extends Model
{
    protected $fillable = ['nni', 'nom', 'prenom', 'matricule', 'sexe', 'updated_at', 'created_at', 'date_naissance','service','image','date_intervention','grade'];

    public function getDateFormat(){
        return 'Y-m-d H:i:s.v';
    }

    public static function findByMatricule(String $matricule){
        return Intervenant::where('matricule','=',$matricule);
    }




    public function affaires(){
        return $this->belongsTo('App\Affaire');
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


}

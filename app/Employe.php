<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Employe extends Model
{
    protected $fillable = ['nni', 'nom', 'prenom', 'matricule', 'statut', 'sexe', 'employe_id', 'updated_at', 'created_at', 'date_naissance'];
    public function getDateFormat(){
        return 'Y-m-d H:i:s.v';
    }
    //public $timestamps  = false;
    public function fromDateTime($value)
    {
        // Only for MSSQL
        if(env('DB_CONNECTION') == 'sqlsrv') {
            return Carbon::parse(parent::fromDateTime($value))->format('Y-d-m H:i:s.v');
        }
        return $value;
    }

    public function couples(){
        return $this->hasMany('App\Couple');
    }
    public function enfants(){
        return $this->hasMany('App\Enfant');
    }
}

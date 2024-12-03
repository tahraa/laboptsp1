<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class EnfantB extends Model
{
    protected $fillable = ['nni', 'nom', 'prenom', 'statut', 'sexe', 'employe_id', 'date_naissance', 'scolarite', 'matricule', 'type', 'handicap', 'service', 'image','num_cnam', 'beneficier_id'];
    public function getDateFormat(){
        return 'Y-m-d H:i:s.v';
    }
    public $timestamps  = false;
    public function fromDateTime($value)
    {
        // Only for MSSQL
        if(env('DB_CONNECTION') == 'sqlsrv') {
            return Carbon::parse(parent::fromDateTime($value))->format('Y-d-m H:i:s.v');
        }
        return $value;
    }




    public function beneficier(){
        return $this->belongsTo('App\Beneficier');
    }
}

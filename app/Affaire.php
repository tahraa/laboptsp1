<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
class Affaire extends Model
{

    protected $fillable = ['num_affaire', 'type', 'date','num_affaire_c','num_soit','lieu_crime','reference','partie_declarent','lieu_prelevement','date_prelevement','periode','victim'];
    public function getDateFormat(){
        return 'Y-m-d H:i:s.v';
    }
    public $timestamps  = false;
    public function fromDateTime($value)
    {
        if(env('DB_CONNECTION') == 'sqlsrv') {
            return Carbon::parse(parent::fromDateTime($value))->format('Y-d-m H:i:s.v');
        }
        return $value;
    }
    public static function findByNum_affaire(String $num_affaire){
        return Affaire::where('num_affaire','=',$num_affaire);
    }

    public function rapports(){
        return $this->hasMany('App\Rapport');
    }
    public function reserves(){
        return $this->hasMany('App\Reserve');
    }

 public function echantillons(){
        return $this->hasMany('App\Echantillon');
    }
  

    public function intervenants(){
        return $this->hasMany('App\Intervenant');
    }
	  public function commiseriat(){
        return $this->belongsTo('App\Commiseriat');
    }
	   public function geneticProfiles()
    {
        return $this->belongsToMany(GeneticProfile::class, 'affaire_genetic_profile')
                    ->withTimestamps();
    }
}

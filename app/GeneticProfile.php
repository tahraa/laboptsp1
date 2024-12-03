<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneticProfile extends Model
{
    protected $fillable = [
        'genetic_marker_id',
        'code', 'affaire_id', 'prenom', 'nom', 'nni', 'date_naissance', 
        'lieu_naissance', 'motif_nom', 'is_known', 'nomcriminel'
    ];

    public function affaires()
    {
        return $this->belongsToMany(Affaire::class)
                    ->withTimestamps();
    }

	  public function geneticMarker()
    {
        return $this->hasOne(GeneticMarker::class);
    }
	 public function profilY()
    {
        return $this->hasOne(ProfilY::class);
    }
}


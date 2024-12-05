<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilY extends Model
{
	protected $fillable = [
    'genetic_profile_id',
    'DYS576', 'DYS389I', 'DYS448', 'DYS389II', 'DYS19', 'DYS391', 'DYS481', 
    'DYS549', 'DY533', 'DY438', 'DY437', 'DYS570', 'DYS635', 'DYS390', 
    'DYS439', 'DYS392', 'DYS643', 'DYS393', 'DYS458', 'DYS385', 'DYS456', 
    'YGATAH4',
];
  

  public function geneticProfile()
{
    return $this->belongsTo(GeneticProfile::class, 'genetic_profile_id');
}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilY extends Model
{
   
    protected $fillable = [
        'genetic_profile_id',
        'DYS576_a', 'DYS576_b',
        'DYS389I_a', 'DYS389I_b',
        'DYS448_a', 'DYS448_b',
        'DYS389II_a', 'DYS389II_b',
        'DYS19_a', 'DYS19_b',
        'DYS391_a', 'DYS391_b',
        'DYS481_a', 'DYS481_b',
        'DYS549_a', 'DYS549_b',
        'DY533_a', 'DY533_b',
        'DY438_a', 'DY438_b',
        'DY437_a', 'DY437_b',
        'DYS570_a', 'DYS570_b',
        'DYS635_a', 'DYS635_b',
        'DYS390_a', 'DYS390_b',
        'DYS439_a', 'DYS439_b',
        'DYS392_a', 'DYS392_b',
        'DYS643_a', 'DYS643_b',
        'DYS393_a', 'DYS393_b',
        'DYS458_a', 'DYS458_b',
        'DYS385_a', 'DYS385_b',
        'DYS456_a', 'DYS456_b',
        'YGATAH4_a', 'YGATAH4_b',
    ];

  public function geneticProfile()
{
    return $this->belongsTo(GeneticProfile::class, 'genetic_profile_id');
}
}

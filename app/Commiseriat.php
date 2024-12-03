<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commiseriat extends Model
{

 protected $fillable = ['region', 'nom','contact'];

 public function affaires(){
        return $this->hasMany('App\Affaire');
    }






}

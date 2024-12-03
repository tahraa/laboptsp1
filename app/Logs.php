<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Logs extends Model
{
    protected $fillable = ['user', 'email', 'action','entite', 'updated_at', 'created_at','userid'];
    public function getDateFormat(){
        return 'Y-m-d H:i:s.v';
    }
    // public $timestamps  = false;
    public function fromDateTime($value)
    {
        // Only for MSSQL
        if(env('DB_CONNECTION') == 'sqlsrv') {
            return Carbon::parse(parent::fromDateTime($value))->format('Y-d-m H:i:s.v');
        }
        return $value;
    }

}

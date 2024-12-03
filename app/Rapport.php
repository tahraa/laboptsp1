<?php
//vih
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
class Rapport extends Model
{
    protected $fillable = ['num_affaire', 'date','echantillons','f_genotypage','f_Q','section','methode_analyse','conclusion','pdf'];
    public function getDateFormat(){
        return 'Y-m-d H:i:s.v';
    }
    public $timestamps  = false;
    public function fromDateTime($value)
    {
       //mohim <li> <a href ="{{asset('/emp_images/'. $employe->matricule .'.pdf')}}">Rapport</a> </li>
       //      <td><input style="width: 200px" maxlength="6" required="required"  type="text" name="service" class="form-control" value="{{ old('service') }}" /> </td>

        // Only for MSSQL
        if(env('DB_CONNECTION') == 'sqlsrv') {
            return Carbon::parse(parent::fromDateTime($value))->format('Y-d-m H:i:s.v');
        }
        return $value;
    }

    public function affaire(){
        return $this->belongsTo('App\Affaire');
    }

}

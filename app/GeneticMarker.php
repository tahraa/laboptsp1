<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneticMarker extends Model
{

    protected $fillable = [
        'genetic_profile_id',
        'D3S1358_a', 'D3S1358_b', 'D3S1358_c',
        'D1S1656_a', 'D1S1656_b', 'D1S1656_c',
        'D6S1043_a', 'D6S1043_b', 'D6S1043_c',
        'D13S317_a', 'D13S317_b', 'D13S317_c',
        'Penta_E_a', 'Penta_E_b', 'Penta_E_c',
        'D16S539_a', 'D16S539_b', 'D16S539_c',
        'D18S51_a', 'D18S51_b', 'D18S51_c',
        'D2S1338_a', 'D2S1338_b', 'D2S1338_c',
        'DSF1PO_a', 'DSF1PO_b', 'DSF1PO_c',
        'Penta_D_a', 'Penta_D_b', 'Penta_D_c',
        'THO1_a', 'THO1_b', 'THO1_c',
        'VWA_a', 'VWA_b', 'VWA_c',
        'D21S11_a', 'D21S11_b', 'D21S11_c',
        'D7S820_a', 'D7S820_b', 'D7S820_c',
        'D55818_a', 'D55818_b', 'D55818_c',
        'TPOX_a', 'TPOX_b', 'TPOX_c',
        'D8S1179_a', 'D8S1179_b', 'D8S1179_c',
        'D12S391_a', 'D12S391_b', 'D12S391_c',
        'D19S433_a', 'D19S433_b', 'D19S433_c',
        'FGA_a', 'FGA_b', 'FGA_c','Amel'
    ];


// GeneticMarker.php
public function geneticProfile()
{
    return $this->belongsTo(GeneticProfile::class, 'genetic_profile_id');
}

}


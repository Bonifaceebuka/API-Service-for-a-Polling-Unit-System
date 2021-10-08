<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnouncedPollUnitResult extends Model
{
    protected $table = 'announced_pu_results';
    public $timestamps = false;    
    protected $fillable = [
        'polling_unit_uniqueid',
        'party_abbreviation', 	
        'party_score',
        'entered_by_user',
        'date_entered',
        'user_ip_address' 	
    ];
public function polling_unit(){
	return $this->hasOne(PollingUnit::class,'uniqueid','result_id');
}


}

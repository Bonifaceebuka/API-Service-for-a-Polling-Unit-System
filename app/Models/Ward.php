<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'ward';
    protected $primaryKey = 'uniqueid';
    protected $fillable = [
		'uniqueid',
        'ward_id',
        'ward_name'. 	
        'lga_id',
        'ward_description',
        'entered_by_user',
        'date_entered',
        'user_ip_address' 	
    ];
public function polling_unit(){
	return $this->hasMany(PollingUnit::class,'ward_id','uniqueid');
}

public function local_govt_area(){
	return $this->belongsTo(LocalGovtArea::class,'lga_id','uniqueid');
}

}

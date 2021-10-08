<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalGovtArea extends Model
{
    protected $table = 'lga';
    protected $fillable = [
		'uniqueid',
        'lga_id',
        'user_ip_address', 	
        'lga_name',
        'state_id',
        'lga_description',
        'entered_by_user',
        'date_entered' 	 	
    ];
public function polling_unit(){
	return $this->hasMany(PollingUnit::class,'lga_id','uniqueid');
}

public function ward(){
	return $this->hasMany(Ward::class,'lga_id','uniqueid');
}
public function state(){
	return $this->belongsTo(State::class,'state_id','state_id');
}

}

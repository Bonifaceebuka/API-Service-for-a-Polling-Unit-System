<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollingUnit extends Model
{
	protected $table = 'polling_unit';
    protected $primaryKey = 'uniqueid';	
    protected $fillable = [
		'uniqueid',
		'polling_unit_id',
		'ward_id',
		'lga_id',
		'uniquewardid',
		'polling_unit_number',
		'polling_unit_name',
		'polling_unit_description', 	
		'lat',
		'long',
		'entered_by_user',
		'user_ip_address',
		'date_entered' 	
    ];
public function ward(){
	return $this->belongsTo(Ward::class,'ward_id','uniqueid');
}

public function lga(){
	return $this->belongsTo(LocalGovtArea::class,'lga_id','uniqueid');
}
}

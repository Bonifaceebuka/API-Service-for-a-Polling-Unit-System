<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    protected $fillable = [
		'state_id',
        'state_name' 	 	
    ];

public function ward(){
	return $this->hasMany(Ward::class,'uniqueid');
}

public function lga(){
	return $this->belongsTo(LocalGovtArea::class,'uniqueid','lga_id');
}
}

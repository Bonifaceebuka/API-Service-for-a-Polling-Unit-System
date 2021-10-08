<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $table = 'party';
    public $timestamps = false;
    protected $fillable = [
        'partyid',
        'partyname', 	
    ];

}

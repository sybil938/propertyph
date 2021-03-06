<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class Apartment extends Model
{
    protected $table = 'apartments';

    protected $fillable = [
    	'user_id',
    	'unit_number',
    	'street',
    	'city',
    	'province',
    	'postal_code',
    	'country',
    	'number_of_apartments',
    	'amenities',
    	'description',
    	'terms',
    	'images'
   	];

	
	public function user(){
        return $this->belongsTo('App\User', 'user_id');
	}

	public function stat(){
        return $this->belongsTo('App\Meta', 'status');
	}

	public function ptype(){
        return $this->belongsTo('App\Meta', 'type');
	}

}


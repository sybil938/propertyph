<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
   
    protected $table = 'user_profiles';
    
	protected $fillable = [
		'user_id', 
		'phone', 
		'birthday', 
		'house_number',
		'street',
		'city',
		'province',
		'postal_code',
		'country',
		'valid_id'
	];

}

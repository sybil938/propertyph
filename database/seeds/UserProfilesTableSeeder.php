<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Profile;

class UserProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	Profile::create([
			'user_id' 		=> 1,
			'phone' 		=> '',
			'birthday'		=> '', 
			'house_number'	=> '',
			'street'		=> '',
			'city'			=> '',
			'province'		=> '',
			'postal_code'	=> '',
			'country'		=> '',
			'valid_id'		=> '',
		]);		

		Profile::create([
			'user_id' 		=> 2,
			'phone' 		=> '',
			'birthday'		=> '', 
			'house_number'	=> '',
			'street'		=> '',
			'city'			=> '',
			'province'		=> '',
			'postal_code'	=> '',
			'country'		=> '',
			'valid_id'		=> '',
		]);		

    }
}

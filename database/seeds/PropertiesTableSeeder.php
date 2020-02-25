<?php

use Illuminate\Database\Seeder;
use App\Property;
use Carbon\Carbon;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
        Property::create([
        	'user_id'		=> 2,
			'type'   		=> 'house',
			'rooms'  		=> '3',
			'house_number'  => '1056',
			'neighborhood'  => 'Nova Tierra Village',
			'barangay'      => 'Sasa',
			'city'          => 'Davao',
			'country'		=> 'Philippines',
			'postal_code'  	=> '8000',
			'created_at' 	=> Carbon::now(),
			'updated_at' 	=> Carbon::now()
      	]);
        Property::create([
        	'user_id'		=> 2,
			'type'   		=> 'condo',
			'rooms'  		=> '3',
			'house_number'  => '80',
			'neighborhood'  => 'Abreeza Place Tower 1',
			'barangay'      => 'Bajada',
			'city'          => 'Davao',
			'country'		=> 'Philippines',
			'postal_code'  	=> '8000',
			'created_at' 	=> Carbon::now(),
			'updated_at' 	=> Carbon::now()
      	]);


    }
}

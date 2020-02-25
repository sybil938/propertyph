<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class MetasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('metas')->insert([

         	//USER STATUS
	        [
	          'name'       => 'Active',
	          'type'       => 'user-status',
	          'value'      => 'active',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now()
	        ],
	        [
	          'name'       => 'Inactive',
	          'type'       => 'user-status',
	          'value'      => 'inactive',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now()
	        ],	

	        //PROPERTY TYPE
	        [
	          'name'       => 'Apartment',
	          'type'       => 'property-type',
	          'value'      => 'apartment',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now()
	        ],
	        [
	          'name'       => 'Condominium',
	          'type'       => 'property-type',
	          'value'      => 'condominium',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now()
	        ],
	        [
	          'name'       => 'Dormitory',
	          'type'       => 'property-type',
	          'value'      => 'dormitory',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now()
	        ],
	        [
	          'name'       => 'House',
	          'type'       => 'property-type',
	          'value'      => 'house',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now()
	        ],	

	        //PROPERTY STATUS        
	        [
	          'name'       => 'Vacant',
	          'type'       => 'property-status',
	          'value'      => 'vacant',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now()
	        ],
	        [
	          'name'       => 'Occupied',
	          'type'       => 'property-status',
	          'value'      => 'occupied',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now()
	        ],	

	        //PROPERTY AMMENITIES        
	        [
	          'name'       => 'Pool',
	          'type'       => 'property-ammenities',
	          'value'      => 'pool',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now()
	        ],
	        [
	          'name'       => 'Car Park',
	          'type'       => 'property-ammenities',
	          'value'      => 'car park',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now()
	        ],	
	        [
	          'name'       => 'Outdoor Kitchen',
	          'type'       => 'property-ammenities',
	          'value'      => 'outdoor kitchen',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now()
	        ],
	        [
	          'name'       => 'Lawn',
	          'type'       => 'property-ammenities',
	          'value'      => 'lawn',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now()
	        ],	        


      	]);
    }
}

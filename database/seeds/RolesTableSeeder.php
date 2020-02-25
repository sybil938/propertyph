<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
	        [
	          'name'       => 'Administrator',
	          'slug'       => 'administrator',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now()
	        ],
	        [
	          'name'       => 'Property Manager',
	          'slug'       => 'property-manager',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now()
	        ],  
	        [
	          'name'       => 'Property Supervisor',
	          'slug'       => 'property-supervisor',
	          'created_at' => Carbon::now(),
	          'updated_at' => Carbon::now()
	        ],  	              
      	]);
    }
}

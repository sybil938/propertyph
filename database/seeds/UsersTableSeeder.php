<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Helpers\Encryption;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
          'first_name'  => 'Ian Anthony',
          'middle_name' => 'Migs',
          'last_name'   => 'Apa',
          'email'       => 'migs@exarcha.com',
          'password'    => bcrypt('!exarcha'),
          'role_id'     => 1,
          'status'      => 1,
          'created_at'  => Carbon::now(),
          'updated_at'  => Carbon::now()
      ]);
      User::create([
          'first_name'  => 'Caroline',
          'middle_name' => 'Acedo',
          'last_name'   => 'Torres',
          'email'       => 'sybil938@gmail.com',
          'password'    => bcrypt('!iamronron'),
          'role_id'     => 1,
          'status'      => 1,
          'created_at'  => Carbon::now(),
          'updated_at'  => Carbon::now()
      ]);
    }
}

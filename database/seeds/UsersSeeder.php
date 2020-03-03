<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::Create([
        	'name' => 'jorge',        	
        	'lastName' => 'paz',        	
        	'email' => 'jp@yahoo.es',        	      	
        	'password' => bcrypt('secret'),        	        	
        ]);

        User::Create([
        	'name' => 'fabio',        	
        	'lastName' => 'portillo',        	
        	'email' => 'fp@yahoo.es',        	      	
        	'password' => bcrypt('secret'),        	        	
        ]);
    }
}

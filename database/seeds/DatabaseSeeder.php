<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
 
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    	foreach (range(1,5) as $index) {
	        $user = DB::table('users')->insertGetId([
	            'name' => $faker->name,
	            'email' => $faker->email,
	            'password' => bcrypt('secret'),
	        ]);

	        foreach (range(1,10) as $i) {
		        $item = DB::table('items')->insert([
		            'name' => $faker->name,
		            'qty' => rand(100,200),
		            'price' => rand(500,2000),
		            'manufacturer' => rand(1,7),
		            'model' => rand(1,10),
		            'date_of_purchased' => '2018-12-22',
		            'user_id' => $user,
		        ]);
		    }
    	}
	}
}
<?php

use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            'product_id' => '1',
            'img' => '1.jpg'
        ]);
		DB::table('images')->insert([
            'product_id' => '2',
            'img' => '2.jpg'
        ]);
		DB::table('images')->insert([
            'product_id' => '3',
            'img' => '3.jpg'
        ]);
		DB::table('images')->insert([
            'product_id' => '4',
            'img' => '4.jpg'
        ]);
		DB::table('images')->insert([
            'product_id' => '5',
            'img' => '5.jpg'
        ]);
		DB::table('images')->insert([
            'product_id' => '6',
            'img' => '6.jpg'
        ]);
		DB::table('images')->insert([
            'product_id' => '7',
            'img' => '7.jpg'
        ]);
		DB::table('images')->insert([
            'product_id' => '8',
            'img' => '8.jpg'
        ]);
		DB::table('images')->insert([
            'product_id' => '9',
            'img' => '9.jpg'
        ]);
		DB::table('images')->insert([
            'product_id' => '10',
            'img' => '10.jpg'
        ]);
    }
}

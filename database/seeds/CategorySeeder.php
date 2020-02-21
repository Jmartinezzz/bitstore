<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::Create([
        	'name' => 'Placas',        	
        	'description' => '',
        ]);

        Category::Create([
        	'name' => 'Sensores',        	
        	'description' => '',
        ]);

        Category::Create([
        	'name' => 'Componentes',        
        	'description' => '',
        ]);



    }
}

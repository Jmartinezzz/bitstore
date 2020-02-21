<?php

use Illuminate\Database\Seeder;
use App\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::Create([
        	'companyName' => 'China mobile',        	
        	'contactName' => 'Ichigo Kurosaki',        	
        	'title' => 'Agente de ventas',        	
        	'email' => 'kurosaki@yahoo.es',        	
        	'phone' => '',        	        	
        ]);
        Supplier::Create([
        	'companyName' => 'Asia arduinos',        	
        	'contactName' => 'Rukia kuchiki',        	
        	'title' => 'Agente de ventas',        	
        	'email' => 'rukia@yahoo.es',        	
        	'phone' => '',        	        	
        ]);
        Supplier::Create([
        	'companyName' => 'Arduinostore',        	
        	'contactName' => 'Juan Perdomo',        	
        	'title' => 'Vendedor',        	
        	'email' => 'perdomo@yahoo.es',        	
        	'phone' => '7456-8990',        	        	
        ]);
        Supplier::Create([
        	'companyName' => 'Placas everywhere',        	
        	'contactName' => 'Yoni mikel',        	
        	'title' => 'Vendedor',        	
        	'email' => 'mikel@yahoo.es',        	
        	'phone' => '7888-1234',        	        	
        ]);
        Supplier::Create([
        	'companyName' => 'Electro tienda',        	
        	'contactName' => 'Marilyn monson',        	
        	'title' => 'Gerente',        	
        	'email' => 'mari99@yahoo.es',        	
        	'phone' => '',        	        	
        ]);
    }
}

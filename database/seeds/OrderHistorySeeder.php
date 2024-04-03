<?php

use App\Order;
use Illuminate\Database\Seeder;

class OrderHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userID = 3;
        $order = Order::create([
            'user_id' => $userID,
            'date' => '2024-04-01',
            'nOrder' => 1,
            'state' => 'pagado',
            'total' => 200.00
        ]);

        $products = [
            4 => ['quantity' => 2, 'subTotal' => 10.00],
            5 => ['quantity' => 1, 'subTotal' => 15.00],
            3 => ['quantity' => 1, 'subTotal' => 15.00]
        ];
        
        $order->products()->attach($products);
    }
}

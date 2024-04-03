<?php

namespace App\Services;

use Auth;
use App\Order;

class CartService 
{
    public function updateOrder(Order $order, array $quantities, array $subtotals)
    {
        $order->products->each(function ($product, $index) use ($quantities, $subtotals) {
            $product->pivot->update([
                'quantity' => $quantities[$index],
                'subTotal' => $subtotals[$index]
            ]);
        });
        
        $total = $order->products->sum('pivot.subTotal');
        $order->total = $total;
        $order->save();	
    }
    
    public function addProduct($product)
    {
        $cart = Order::where('user_id',Auth::user()->id)
            ->where('state', 'carrito')
            ->first();
        if ($cart && $cart->products()->count()) {
            $productInCart = $cart->products->contains('id', $product->id);
            if ($productInCart) {
                return response()->json(['mensaje' => 'existe']);
            }

            $cart->products()->attach($product, ['quantity' => 1]);	    		  		
            return response()->json(['mensaje' => 'agregado']);
        }else{
            $cart = new Order;
            $cart->user_id = Auth::user()->id;    		
            $cart->date = now();
            $cart->state = 'carrito';
            $cart->total = 0.0;
            $cart->save();
            $cart->products()->attach($product, ['quantity' => 1]);  
            return response()->json(['mensaje' => 'agregado']);  		    	
        }
    }

    public function removeProduct ($request, $product) {
        $cart = Order::where('user_id', $request->query('userId'))
				->where('state', 'carrito')
				->first();
        if($cart) {
			$cart->products()->detach($product);
			return response()->json(['mensaje' => 'eliminado']);		
    	}else{
    		return response()->json(['mensaje' => 'error']);
    	}    
    }

}
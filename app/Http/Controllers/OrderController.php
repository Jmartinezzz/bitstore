<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\Product;

class OrderController extends Controller
{
    public function addCart(Request $request, Product $prod){
    	if($request->ajax()){
    		$carrito = new Order;      
    	
	    	if (Order::where('user_id',Auth::user()->id)->where('state', 'carrito')->first()) {
	    		
	    		$carrito = Order::where('user_id',Auth::user()->id)->where('state', 'carrito')->first();
	    		if ($carrito->products()->count() > 0) {
	    			$arr = array();
	    			foreach ($carrito->products as $i) {
	    				if ($i->id == $prod->id) {
	    					return response()->json(['mensaje' => 'existe']);
	    				}
	    			}	    				    		
	    		}
	    		$carrito->products()->syncWithoutDetaching($prod);
	    		  		
	    		return response()->json(['mensaje' => 'agregado']);
	    	}else{
	    		$carrito->user_id = Auth::user()->id;    		
	    		$carrito->date = now();
	    		$carrito->state = 'carrito';
	    		$carrito->total = 0.0;
	    		$carrito->save();
	    		$carrito->products()->sync($prod);  
	    		return response()->json(['mensaje' => 'agregado']);  		    	
	    	}
    	} 	
    }
}

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
	    		$carrito->products()->attach($prod, ['quantity' => 1]);
	    		  		
	    		return response()->json(['mensaje' => 'agregado']);
	    	}else{
	    		$carrito->user_id = Auth::user()->id;    		
	    		$carrito->date = now();
	    		$carrito->state = 'carrito';
	    		$carrito->total = 0.0;
	    		$carrito->save();
	    		$carrito->products()->attach($prod, ['quantity' => 1]);  
	    		return response()->json(['mensaje' => 'agregado']);  		    	
	    	}
    	} 	
    }

    public function delCart(Request $request, Product $prod){
    	if ($request->ajax()) {
    		if ($prods = Order::where('user_id',Auth::user()->id)->where('state', 'carrito')->first()) {
    			foreach($prods->products as $i) {
	    				if ($i->id == $prod->id) {
	    					$prods->products()->detach($prod);
	    					return response()->json(['mensaje' => 'eliminado']);
	    				}
	    		}	    			
    		}else{
    			return response()->json(['mensaje' => 'error']);
    		}    		
    	}
    }

    public function guardar(Request $request, Order $order){
    	if ($request->ajax()) {
    		$i = 0;
    		$total = 0;
    		$orden = Order::where('user_id',Auth::user()->id)->where('state', 'carrito')->first();
    
  			foreach ($orden->products as $prod) {
				$orden->products()->updateExistingPivot($prod, ['quantity' => $request->cantidad[$i], 'subTotal' => $request->subTotal[$i]]);				
				$total += $request->subTotal[$i];
				$i++;
			}

			$orden->total =	$total;
			$orden->save();		
    		
    		return response()->json(['mensaje' => 'guardado']);
    	}
    }
}

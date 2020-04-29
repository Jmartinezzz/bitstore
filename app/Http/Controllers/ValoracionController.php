<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ValoracionController extends Controller
{
    public function index(){
    	$productos = Product::take(3)->get();
    	
    	return view('store.info.valoracion', ['productos' => $productos]);
    }

    // funcion para aumentar los me gusta delproducto en 1
    public function sumarLike(Product $product){
    	$product->increment('gusta', 1);    	    	
    	return response()->json(['mensaje' => 'votado']);    	    
    }

    // funcion para aumentar los no me gusta del producto en 1
    public function restarLike(Product $product){
    	$product->increment('noGusta', 1);    	    	
    	return response()->json(['mensaje' => 'votado']);    	    
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Product;

class ValoracionController extends Controller
{
    public function index(){
    	$request = request();
    	$usuario = DB::table('cif')->select('cif')
		    	->where('cif', $request->cif)
		    	->where('pass', $request->password)->first();    
    	if ($usuario) {
    		$productos = Product::take(3)->get();    	
    		return view('store.info.valoracion', ['productos' => $productos, 'usuario' => $usuario]);
    	}else{
    		return redirect()->back()->with('mensaje', "Error, revise sus credenciales");
    	}
    	
    }

    public function falsoLogin(){    	
    	return view('store.info.falsoLogin');
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

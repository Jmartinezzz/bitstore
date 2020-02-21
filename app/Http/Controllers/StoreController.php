<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class StoreController extends Controller
{
    public function index()
    {     
        return view('store.index');
    }

    public function products()
    {     
    	$placas = Product::where('category_id', 1)->orWhere('category_id', 2)->get();    	
    	// $sensores = Product::where('category_id', 2)->get();
    	$componentes = Product::where('category_id', 3)->get();
    	
        return view('store.products.index', ['placas' => $placas, 'componentes' =>$componentes]);
    }
}

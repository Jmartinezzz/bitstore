<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Video;

class StoreController extends Controller
{
    public function index()
    {
        $masVendidos = Product::orderBy('soldout', 'DESC' )
            ->with('images')
            ->take(4)
            ->get();
        $products = Product::with('images')->take(4)->get();

        return view('store.index', ['products' => $products, "vendidos" => $masVendidos]);
    }

    public function contact()
    {
        return view('store.info.contactanos');
    }

    public function company()
    {
        return view('store.info.empresa');
    }

    public function media()
    {
        $videos = Video::all();
        return view('store.info.videoteca', ['videos' => $videos]);
    }

    public function products()
    {
        $products = Product::all();
        [$componentes, $placas] = $products->partition(function ($product) {
            return $product->category_id == 3;
        });
    	
        return view('store.products.index', [
            'placas' => $placas,
            'componentes' =>$componentes,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $destinos = DB::table('destinos')->get();  
        return view('destinos.index', ['destinos' => $destinos]);
    }

    public function search(Request $request)
    {
    	// dd($request->all());
        $destinos = DB::table('destinos')
        			->where('lugar','like', '%' . $request->lugar . '%')
        			->where('categoria','like', '%' . $request->categoria . '%')  
        			->where('deprtamento','like', '%' . $request->departamento . '%')  
        			->where('ciudad','like', '%' . $request->ciudad . '%')       
        			->get();        
        return view('destinos.index', ['destinos' => $destinos]);
    }
}

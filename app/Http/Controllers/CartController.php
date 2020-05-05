<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Auth;
use App\Order;
use App\Product;
use App\User;

class CartController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::check()) {
           return redirect()->route('store.index');
        }
        if (Order::where('user_id',Auth::user()->id)->get() && Order::where('user_id',Auth::user()->id)->where('state', 'carrito')->count() > 0) {
            $productos = Order::where('user_id',Auth::user()->id)->where('state', 'carrito')->first() ;

        }else{
            $productos = 0;            
        }        

        $datosUsuario = User::find(Auth::user()->id);                     
        return view('store.cart.index', ['productos' => $productos, 'datosUsuario' => $datosUsuario]);
    }

   
    public function proccesarCompra(Request $request)
    {
        if (!Auth::check()) return redirect()->route('store.index');
        $orden = Order::where('user_id',Auth::user()->id)->where('state', 'carrito')->first();
        $result = array();
        $imagedata = base64_decode($_POST['img_data']);
        $filename = Auth::user()->id;
        //Location to where you want to created sign image
        $file_name = public_path().'/img/firmas/'.$filename.'.png';        
        file_put_contents($file_name,$imagedata);
        $result['status'] = 1;
        $result['file_name'] = $file_name;
        $orden->state = 'pagado';
        $orden->save();
        /*para el bot*/ 
        try {
            $botToken="1155339999:AAGBYb3Pu9dpScI5JxK-AyJLACOKmaZbD1c";
            $website="https://api.telegram.org/bot".$botToken;
            $fecha = date('d-m-Y h:i:s');

            $tex=urlencode("⚠Nueva venta realizada: \n ✔️ Usuario: ".Auth::user()->name ."\n  Total: $orden->total \nFecha y hora: $fecha");   
            file_get_contents($website."/sendmessage?chat_id=768944027&text=$tex");
        } catch (Exception $e) {
                
        }
        /*final del bot*/   
        $p = new Product;
        $p->verificarStock(); 
        return response()->json(['mensaje' => 'guardado']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function history(Request $request)
    {
        if (!Auth::check()) {
           return redirect()->route('store.index');
        }
      
        if (Order::where('user_id',Auth::user()->id)->get() && Order::where('user_id',Auth::user()->id)->where('state', 'pagado')->count() > 0) {
            $productos = Order::where('user_id',Auth::user()->id)->where('state', 'pagado')
            ->orderBy('id', 'desc')
            ->get();
        }else{
            $productos = array();
        }
        $datosUsuario = User::find(Auth::user()->id);
        // dd(count($productos));
        return view('store.cart.history', ['productos' => $productos, 'datosUsuario' => $datosUsuario]);
    }

    
    public function pdf(Request $request)
    {
        $productos = Order::where('user_id',Auth::user()->id)->where('state', 'pagado')
            ->where('id', $request->id)
            ->orderBy('id', 'desc')
            ->first();
        $datosUsuario = User::find(Auth::user()->id);          
        $pdf = PDF::loadView('store.cart.detallePDF',['productos' => $productos, 'datosUsuario' => $datosUsuario]);        
        // return $pdf->download('detalle-compra-'.$request->id.'.pdf');
        return $pdf->stream();
    }    
}

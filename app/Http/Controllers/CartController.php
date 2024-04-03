<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Auth;
use App\Order;
use App\Product;
use App\User;
use App\Traits\Bot;

class CartController extends Controller
{   
    use Bot; 
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
        $userId = Auth::user()->id;
        $datosUsuario = User::find($userId);   
        $products = Order::where('user_id', $userId)
            ->where('state', 'carrito')
            ->with('products')
            ->first();
        return view('store.cart.index', ['productos' => $products ?? 0, 'datosUsuario' => $datosUsuario]);
    }

   
    public function proccesarCompra(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('store.index');   
        }
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

        //crear pdf de la orden
       $productos = $orden->where('user_id',Auth::user()->id)->where('state', 'pagado')
            ->where('id', $orden->id)
            ->orderBy('id', 'desc')
            ->first();
        
        $pdf = PDF::loadView('store.cart.detallePDF',['productos' => $productos]);        
        $pdf->save(public_path(). '/pdf/'.Auth::user()->id . '.pdf');

        // agregar soldout a cada producto
        foreach($orden->products as $product) {
            $product->agregarSoldOut($product->pivot->quantity);
            $product->restarStock($product->pivot->quantity);
        }

        $botMsgContent = "⚠Nueva venta realizada: \n ✔️ Usuario: ".Auth::user()->name ."\n  Total: $orden->total \nFecha y hora: date('d-m-Y h:i:s')";
        $this->sendInteraction($botMsgContent);

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
    public function history()
    {
        if (!Auth::check()) {
           return redirect()->route('store.index');
        }

        $products = Order::orderItems('history')->get();
        return view('store.cart.history', ['productos' => $products]);
    }

    
    public function pdf(Request $request)
    {
        $products = Order::orderItems('pdf', $request)->first();
   
        $pdf = PDF::loadView('store.cart.detallePDF', [
            'productos' => $products
        ]);        
        return $pdf->stream();
    }    

}

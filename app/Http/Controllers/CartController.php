<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Services\CartService;
use Auth;
use App\Order;
use App\Product;
use App\User;
use App\Traits\Bot;

class CartController extends Controller
{
    use Bot;

    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

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
        if (!Auth::check()) {
            return redirect()->route('store.index');
        }
        $orden = Order::where('user_id', Auth::user()->id)->where('state', 'carrito')->first();

        $this->cartService->storeSignatureImg($request->img_data);
        
        $orden->state = 'pagado';
        $orden->save();

        $this->cartService->createOrderPdf($orden);
        $this->cartService->updateProductStockAndSoldOut($orden);
       
        $botMsgContent = "⚠Nueva venta realizada: \n ✔️ Usuario: ".Auth::user()->name ."\n  Total: $orden->total \nFecha y hora: date('d-m-Y h:i:s')";
        $this->sendInteraction($botMsgContent);

        Product::verificarStock();
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

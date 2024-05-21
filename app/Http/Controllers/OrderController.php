<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Http\Requests\UserRequest;

class OrderController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    
    public function addCart(Request $request, Product $prod)
    {
        if ($request->ajax()) {
            if (!Auth::check()) {
                return redirect()->route('store.index');
            }

            return $this->cartService->addProduct($prod);
        }
    }

    public function delCart(Request $request, Product $prod)
    {
        if ($request->ajax()) {
            return $this->cartService->removeProduct($request, $prod);
        }
    }

    public function saveCart(Request $request, Order $order)
    {
        if ($request->ajax()) {
            $this->cartService->updateOrder($order, $request->cantidad, $request->subTotal);
            return response()->json(['mensaje' => 'guardado']);
        }
    }

    public function saveAddress(UserRequest $request)
    {
        if ($request->ajax()) {
            $user = User::find($request->userId);
            $user->update($request->all());
            return response()->json(['mensaje' => 'guardado']);
        }
    }
}

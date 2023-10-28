<?php

namespace App\Http\Controllers;

use App\Helpers\CartHelper;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Cart::where('user_id',Auth::id())->get();
        return view('cart.index',compact('cartItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cartItemExist = Cart::where('user_id',Auth::id())->where('product_id',$request->product_id)->first();
        if($cartItemExist){
            $cartItemExist->update([
                'quantity'=>++$cartItemExist->quantity,
            ]);
        }else{
            Cart::create([
                'user_id'=>Auth::id(),
                'product_id'=>$request->product_id,
                'quantity'=>1,
            ]);
        }


      return response()->json(['status'=>'ok','message'=>'Producto añadido al carrito correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        foreach($request->data as $data){
            Cart::find($data['id'])->update(["quantity"=>$data['quantity']]);
        }
        $totalAmount = CartHelper::getTotalAmount();
        $countItems = CartHelper::countCart();
        return response()->json(['status'=>'ok',
            'totalAmount'=>$totalAmount,
            'countItems'=>$countItems,
            'message'=>"Carrito actualizado correctamente"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $cart = Cart::find($request->item_cart_id);
        if($cart->user_id == Auth::id()){
            $cart->delete();
        }
        $totalAmount = CartHelper::getTotalAmount();
        $countItems = CartHelper::countCart();
        return response()->json(['status'=>'ok',
            'totalAmount'=>$totalAmount,
            'countItems'=>$countItems,
            'message'=>"Elemento del carrito eliminad correctamente"]);
    }
}

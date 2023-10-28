<?php
namespace App\Helpers;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartHelper{


    public static function countCart()
    {
        if(Auth::check()){
            $cart_items =  Cart::where('user_id',Auth::id())->get();
            $totalCount=0;
            foreach ($cart_items as $item){
                $totalCount+= $item->quantity;
            }
            return $totalCount;
        }else{
            return 0;
        }

    }

    public static function getTotalAmount(){
        $cart_items = Cart::where('user_id',Auth::id())->get();
        $totalAmount=0;
        foreach ($cart_items as $item){
            $totalAmount+= $item->quantity*$item->product->price;
        }
        return $totalAmount;
    }
}

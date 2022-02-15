<?php

namespace App\Http\Controllers\User;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class CartPageController extends Controller
{
    //
    public function MyCartView(){
        return view('frontend.wishlist.view_mycar');
    }

    public function GetCartProduct(){
        $carts = Cart::content();
        $cartQty = Cart::count(); 
        $cartTotal = Cart::total();
        return response()->json(array(
            "carts" => $carts,
            "cartQty" => $cartQty,
            "cartTotal" => round($cartTotal)
        ));
    }
    
    public function CartRemove($id){
        Cart::remove($id);
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        return response()->json(["success"=> "You you Have Removed the Item Successfully!"]);  
    }
    // CartIncrement
    public function CartIncrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);
        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();
            Session::put('coupon',[
                "coupon_name" => $coupon->coupon_name,
                "coupon_discount" => $coupon->coupon_discount,
                "discount_amount" => round(Cart::total() * $coupon->coupon_discount / 100),
                "total_amount"=> round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
             ]);
        }
        return response()->json("Increment");  
    }

    public function CartDecrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();
            Session::put('coupon',[
                "coupon_name" => $coupon->coupon_name,
                "coupon_discount" => $coupon->coupon_discount,
                "discount_amount" => round(Cart::total() * $coupon->coupon_discount / 100),
                "total_amount"=> round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
             ]);
        }
        return response()->json("Decrement");  
    }
}

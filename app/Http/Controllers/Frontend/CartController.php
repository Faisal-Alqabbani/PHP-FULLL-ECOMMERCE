<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    //
    public function AddToCart(Request $request, $id){
        $product = Product::findOrFail($id);
        if(Session::has('coupon')){
            Session::forget('coupon');
        }

        if ($product->dicount_price == NULL) {
            # code...
            Cart::add([
                'id' => $id, 
                'name' => $request->productName, 
                'qty' => $request->quantity, 
                'price' => $product->selling_price, 
                'weight' => 1, 
                'options' => [
                    'image' => $product->product_thmbnail,
                    'size' => $request->size,
                    'color' => $request->color,
                    
                    ]]);
           
        }else{
            Cart::add([
                'id' => $id, 
                'name' => $request->productName, 
                'qty' => $request->quantity, 
                'price' => $product->discount_price, 
                'weight' => 1, 
                'options' => [
                    'image' => $product->product_thmbnail,
                    'size' => $request->size,
                    'color' => $request->color,
                    
                    ]]);
        }
        return response()->json(['success' => 'Successfully Added on The Cart!']);


    }

    // get mini cart
    public function GetMinCart(){
        $carts = Cart::content();
        $cartQty = Cart::count(); 
        $cartTotal = Cart::total();
        return response()->json(array(
            "carts" => $carts,
            "cartQty" => $cartQty,
            "cartTotal" => round($cartTotal)
        ));
    }

    public function RemoveItemMiniCart($id){
        Cart::remove($id);
        return response()->json(["success"=> "You you Have Removed the Item Successfully!"]); 
    }

    // add to wishlist
    public function AddToWishList(Request $request, $product_id){
        if(Auth::check()){
           $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();
           if(!$exists){
                Wishlist::insert([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                "created_at" => Carbon::now(),
                ]);
                return response()->json(["success"=> "You have Added Item on Wishlist"]);
           }else{
            return response()->json(["error"=> "This Product Already Exists In Wishlist"]);
           }
          
        }else{
           return response()->json(["error"=> "At First Login Your Account!"]); 
        }
    }

    public function CouponApply(Request $request){
        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();
        if($coupon){
            Session::put('coupon',[
               "coupon_name" => $coupon->coupon_name,
               "coupon_discount" => $coupon->coupon_discount,
               "discount_amount" => round(Cart::total() * $coupon->coupon_discount / 100),
               "total_amount"=> round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
            ]);
            return response()->json(array(
                'success' => "Coupon Apply Successfully!"
            ));
        }else{
            return response()->json(["error"=> "Invalid Coupon"]);
        }
    }

    // CalCulation
    public function CouponCalculation(){
        if (Session::has('coupon')) {
            return response()->json(array(
            'subtotal' => Cart::total(),
            'coupon_name' => session()->get('coupon')['coupon_name'],
            'coupon_discount' => session()->get('coupon')['coupon_discount'],
            'discount_amount' => session()->get('coupon')['discount_amount'],
            'total_amount' => session()->get('coupon')['total_amount'],       
            ));
        }else{
            return response()->json(array(
                'total' => Cart::total(),
            )); 
        }
    }

    public function CouponRemove(){
        Session::forget('coupon');
        return response()->json(['success' => 'You have deleted you coupon successfully!']);
    }

    // Checkout functions 
    public function CheckoutCreate(){
        if(Auth::check()){
            if(Cart::total() > 0){
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();
                $divisions = ShipDivision::orderBy('division_name', "ASC")->get();
                return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal','divisions'));
            }else{
                $notification = array(
                    'message' => 'Shopping At least one product!',
                    'alert-type' => 'error'
                );
    
                return redirect()->route("home")->with($notification);   
            }
        }else{
             $notification = array(
                'message' => 'You Need to login First',
                'alert-type' => 'error'
            );

            return redirect()->route("login")->with($notification); 
        }
    }

    // Checkout Store in DataBase
    public function CheckoutStore(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['post_code'] = $request->post_code;
        $data['notes'] = $request->notes;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['state_id'] = $request->state_id;
        $cartTotal = Cart::total();
        if($request->payment_method == 'stripe'){
            return view('frontend.payment.stripe', compact('data', 'cartTotal'));
        }else if($request->payment_method == 'stripe'){
            return 'card';
        }else{
            return view('frontend.payment.cash', compact('data', 'cartTotal'));
        }

    }
}

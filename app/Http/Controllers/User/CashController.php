<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;
class CashController extends Controller
{
    //
    
    // Cash Order
    public function CashOrder(Request $request){
       
        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }else{
            $total_amount = Cart::total();
        }

        // Order Table
        $order_id = Order::insertGetId([
        'user_id' => Auth::id(),
        'division_id' => $request->division_id,
        'district_id' => $request->district_id,
        'state_id' => $request->state_id,
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
        'post_code' => $request->post_code,
        'notes' => $request->notes,
        'payment_method' => "Cash On Delivery",
        'payment_type' => "Cash On Delivery",
        'currency' => "usd",
        'amount' => $total_amount,
        'invoice_no' => 'FT'.mt_rand(10000000,99999999),
        'order_date' => Carbon::now()->format('d F Y'),
        'order_month' => Carbon::now()->format('F'),
        'order_year' => Carbon::now()->format('Y'),
        'status' => "pending",
        'created_at' => Carbon::now(),
    ]);
    
    // Start Send Email
    $invoice = Order::findOrFail($order_id); 
    // Send Email. 
    $data = [
        "invoice_no" => $invoice->invoice_no,
        "amount" => $total_amount,
        'name' => $invoice->name,
        "email" => $invoice->email,
    ];

    Mail::to($request->email)->send(new OrderMail($data));

    
    $carts = Cart::content();
    foreach($carts as $cart){
        OrderItem::insert([
            'order_id' => $order_id,
            'product_id' => $cart->id,
            'color' => $cart->options->color,
            'size' => $cart->options->size,
            'qty' => $cart->qty,
            'price' => $cart->price,
            'created_at' => Carbon::now(),
        ]);
    }
    // distory Session
    if(Session::has('coupon')){
        Session::forget('coupon');
    }
    Cart::destroy();

    $notification = array(
        'message' => 'Your Order Place Successfully!',
        'alert-type' => 'success'
    );

    return redirect()->route('home')->with($notification);

 
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Auth;

class AllUserController extends Controller
{
    public function MyOrders(){
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        $user = User::findOrFail(Auth::id());
        return view('frontend.user.order.order_view', compact('orders', 'user'));
    }
    // Order details Method
    public function OrderDetails($order_id){
        $order = Order::where('id', $order_id)->with('division','user','state', 'district')->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id','DESC')->get();
        return view('frontend.user.order.order_details', compact('order','orderItem'));

         
    } // End Method
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Carbon;
class CouponController extends Controller
{
    //
    public function CouponView(){
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('backend.coupon.view_coupon', compact('coupons'));
    }

    // Store coupon
    public function CouponStore(Request $request){
        $request->validate([
            "coupon_name" => 'required',
            "coupon_discount" => 'required',
            "coupon_validity" => 'required',
        ]);
        
        // insert brand to the database
        Coupon::insert([
            "coupon_name" => strtoupper($request->coupon_name),
            "coupon_discount" => $request->coupon_discount,
            "coupon_validity" => $request->coupon_validity,
            "created_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "Coupon has been added successfully!",
            "alert-type" => "success",
        );
        return Redirect()->back()->with($notification);
    }
    // edit coupon 
    public function CouponEdit($id){
        $coupon = Coupon::findOrfail($id);
        return view('backend.coupon.edit_view', compact('coupon'));
    }
    public function CouponUpdate(Request $request, $id){
        $request->validate([
            "coupon_name" => 'required',
            "coupon_discount" => 'required',
            "coupon_validity" => 'required',
        ]);
        
        Coupon::findOrFail($id)->update([
            "coupon_name" => strtoupper($request->coupon_name),
            "coupon_discount" => $request->coupon_discount,
            "coupon_validity" => $request->coupon_validity,
            "updated_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "You Have Updated Coupon Successfully!",
            "alert-type" => "info",
        );
        return Redirect()->route('manage-coupon')->with($notification);
    } // End method
    
    public function CouponDelete($id){ 
        Coupon::findOrFail($id)->delete();
        $notification = array(
            "message" => "You Have deleted Coupon Successfully!",
            "alert-type" => "success",
        );
        return Redirect()->back()->with($notification);
    }
}

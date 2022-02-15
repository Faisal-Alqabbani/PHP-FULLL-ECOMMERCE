<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;

class BrandController extends Controller
{
    public function BrandView(){
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view', compact('brands'));
    }
    // store brand
    public function BrandStore(Request $request){
        $request->validate([
            "brand_name_en" => 'required',
            "brand_name_ar" => 'required',
            "brand_image" => 'required',
        ],[
            "brand_name_en.required" => "Input Brand English Name",
            "brand_name_ar.required" => "Input Brand Arabic Name",
        ]);
        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // resize the image with its width and height;
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        // save url to save it in the database
        $save_url = 'upload/brand/'.$name_gen;
        
        // insert brand to the database
        Brand::insert([
            "brand_name_en" => $request->brand_name_en,
            "brand_name_ar" => $request->brand_name_ar,
            "brand_slug_en" => strtolower(str_replace(' ','-', $request->brand_name_en)),
            "brand_slug_ar" => str_replace(' ','-', $request->brand_name_ar),
            "brand_image" => $save_url,
            "created_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "Brand has been added successfully",
            "alert-type" => "success",
        );
        return Redirect()->back()->with($notification);

    }

    public function BrandEdit($id){
        $brand = Brand::find($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    public function BrandUpdate(Request $request){
        $brand_id = $request->id;
        $old_image = $request->old_image;
        if ($request->file('brand_image')) {
        unlink($old_image);
        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // resize the image with its width and height;
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        // save url to save it in the database
        $save_url = 'upload/brand/'.$name_gen;
        
        // insert brand to the database
        Brand::findOrFail( $brand_id)->update([
            "brand_name_en" => $request->brand_name_en,
            "brand_name_ar" => $request->brand_name_ar,
            "brand_slug_en" => strtolower(str_replace(' ','-', $request->brand_name_en)),
            "brand_slug_ar" => str_replace(' ','-', $request->brand_name_ar),
            "brand_image" => $save_url,
            "updated_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "Brand has been updated successfully",
            "alert-type" => "success",
        );
        return Redirect()->route('all.brand')->with($notification);

        } // end if.
        else{
             // insert brand to the database
        Brand::findOrFail( $brand_id)->update([
            "brand_name_en" => $request->brand_name_en,
            "brand_name_ar" => $request->brand_name_ar,
            "brand_slug_en" => strtolower(str_replace(' ','-', $request->brand_name_en)),
            "brand_slug_ar" => str_replace(' ','-', $request->brand_name_ar),
            "brand_image" => $old_image,
            "updated_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "Brand has been updated successfully",
            "alert-type" => "success",
        );
        return Redirect()->route('all.brand')->with($notification);

        } // end else
    }


    public function BrandDelete($id){
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);
        Brand::findOrFail($id)->delete();
        $notification = array(
            "message" => "Brand has been updated successfully",
            "alert-type" => "info",
        );
        return Redirect()->back()->with($notification);
    }

   
}


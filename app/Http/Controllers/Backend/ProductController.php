<?php

namespace App\Http\Controllers\Backend;

use Image;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;

use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function AddProduct(){
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view("backend.product.product_add", compact('categories', 'brands'));
        
    }
    // store product function
    public function StoreProduct(Request $request){

        $image = $request->file('product_thmbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name_gen);
        $save_url = 'upload/products/thambnail/'.$name_gen;

        $product_id = Product::insertGetId([
            "brand_id" => $request->brand_id,
            "category_id" => $request->category_id,
            "subcategory_id" => $request->subcategory_id,
            "subsubcategory_id" => $request->subsubcategory_id,
            "product_name_en" => $request->product_name_en,
            "product_name_ar" => $request->product_name_ar,
            "product_slug_en" => strtolower(str_replace(' ','-', $request->product_name_en)),
            "product_slug_ar" => str_replace(' ','-', $request->product_name_ar),
            "product_code" => $request->product_code,
            "product_qty" => $request->product_qty,
            "product_tags_en" => $request->product_tags_en,
            "product_tags_ar" => $request->product_tags_ar,
            "product_size_en" => $request->product_size_en,
            "product_size_ar" => $request->product_size_ar,
            "product_color_en" => $request->product_color_en,
            "product_color_ar" => $request->product_color_ar,
            "selling_price" => $request->selling_price,
            "discount_price" => $request->discount_price,
            "short_desc_en" => $request->short_desc_en,
            "short_desc_ar" => $request->short_desc_ar,
            "long_desc_en" => $request->long_desc_en,
            "long_desc_ar" => $request->long_desc_ar,
            "hot_deals" => $request->hot_deals,
            "featured" => $request->featured,
            "spicial_offer" => $request->spicial_offer,
            "spicial_deal" => $request->spicial_deal,
            "status" => 1,
            "product_thmbnail" => $save_url,
            "created_at" => Carbon::now(),
        ]); // End Method
        ///////// Multiple Image Upload start ////////////
        $images = $request->file('multi_img');
        foreach($images as $img){
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
            $uploadPath = 'upload/products/multi-image/'.$make_name;
            MultiImg::insert([
                "product_id" => $product_id,
                "photo_name" => $uploadPath,
                "created_at" => Carbon::now(),
            ]);
        }
        $notification = array(
            "message" => "Product has been added successfully",
            "alert-type" => "success",
        );
        return Redirect()->route('manage-product')->with($notification);


        ///////// End Multiple Image Upload start ////////////
        

    }


    public function ProductManage(){
        $products = Product::latest()->get();
        return view('backend.product.product_view', compact('products'));
    }
    // edit your Stuff
    public function ProductEdit($id){
        $multiImgs = MultiImg::where('product_id', $id)->get();
        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $subsubCategory = SubSubCategory::latest()->get();
        $brands = Brand::latest()->get();
        $product = Product::findOrFail($id);
        return view('backend.product.product_edit', compact('categories', 'subcategory', 'subsubCategory', 'brands', 'product','multiImgs'));
    }
    // something went wrong.
    public function ProductDataUpdate(Request $request){
        $product_id = $request->id;
            Product::findOrFail($product_id)->update([
            "brand_id" => $request->brand_id,
            "category_id" => $request->category_id,
            "subcategory_id" => $request->subcategory_id,
            "subsubcategory_id" => $request->subsubcategory_id,
            "product_name_en" => $request->product_name_en,
            "product_name_ar" => $request->product_name_ar,
            "product_slug_en" => strtolower(str_replace(' ','-', $request->product_name_en)),
            "product_slug_ar" => str_replace(' ','-', $request->product_name_ar),
            "product_code" => $request->product_code,
            "product_qty" => $request->product_qty,
            "product_tags_en" => $request->product_tags_en,
            "product_tags_ar" => $request->product_tags_ar,
            "product_size_en" => $request->product_size_en,
            "product_size_ar" => $request->product_size_ar,
            "product_color_en" => $request->product_color_en,
            "product_color_ar" => $request->product_color_ar,
            "selling_price" => $request->selling_price,
            "discount_price" => $request->discount_price,
            "short_desc_en" => $request->short_desc_en,
            "short_desc_ar" => $request->short_desc_ar,
            "long_desc_en" => $request->long_desc_en,
            "long_desc_ar" => $request->long_desc_ar,
            "hot_deals" => $request->hot_deals,
            "featured" => $request->featured,
            "spicial_offer" => $request->spicial_offer,
            "spicial_deal" => $request->spicial_deal,
            "status" => 1,
            "created_at" => Carbon::now(),
        ]); // End Method
        $notification = array(
            "message" => "Product has been udpated successfully, without image",
            "alert-type" => "success",
        );
        return Redirect()->route('manage-product')->with($notification);

    }
    // Multi Image update
    public function MultiImageUpdate(Request $request){
        $imgs = $request->multi_img;
        foreach($imgs as $id => $img){
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
            $uploadPath = 'upload/products/multi-image/'.$make_name;
            MultiImg::where('id', $id)->update([
                "photo_name" => $uploadPath,
                "updated_at" => Carbon::now(),
            ]);  
        } // endforeach
        $notification = array(
            "message" => "Product has been updated its images successfully",
            "alert-type" => "success",
        );
        return Redirect()->back()->with($notification);
    }// end method

    // product Main Thumbnail.
    public function ThmbnailImageUpdate(Request $request){
        $pro_id = $request->id;
        $old_image = $request->old_img;
        unlink($old_image);
        $image = $request->file('product_thmbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name_gen);
        $save_url = 'upload/products/thambnail/'.$name_gen;
        Product::findOrFail($pro_id)->update([
            "product_thmbnail" => $save_url,
            "updated_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "Product has been updated its Thumbnail successfully",
            "alert-type" => "success",
        );
        return Redirect()->back()->with($notification); 
    }


    // Delete Multi Image
    public function MultiDelete($id){
        $old_img = MultiImg::findOrFail($id);
        unlink($old_img->photo_name);
        MultiImg::findOrFail($id)->delete();
        $notification = array(
            "message" => "Image has been deleted successfully",
            "alert-type" => "info",
        );
        return Redirect()->back()->with($notification); 
        
    }

    // product Active
    public function ProductActive($id){
        Product::findOrFail($id)->update([
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            "message" => "Activted Your Product Successfully!",
            "alert-type" => "info",
        );
        return Redirect()->back()->with($notification); 
    }

        // product InActive
        public function ProductInactive($id){
            Product::findOrFail($id)->update([
                'status' => 0,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                "message" => "InActivted Your Product Successfully!",
                "alert-type" => "info",
            );
            return Redirect()->back()->with($notification); 
        }
        // delete Product
        public function ProductDelete($id){
            $product = Product::findOrFail($id);
            unlink($product->product_thmbnail);
            Product::findOrFail($id)->delete();
            
            $images = MultiImg::where('product_id', $id )->get();
            foreach ($images as $image){
                unlink($image->photo_name);
                MultiImg::where('product_id', $id)->delete();
            }
            $notification = array(
                "message" => "You have deleted Product Successfully!",
                "alert-type" => "info",
            );
            return Redirect()->back()->with($notification);
        } // End Method
        
}

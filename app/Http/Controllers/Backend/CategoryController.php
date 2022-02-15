<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;
class CategoryController extends Controller
{
    // category controller;
    public function CategoryView(){
        $categories = Category::latest()->get();
        return view('backend.category.category_view', compact('categories'));
    }

    public function CategoryStore(REquest $request){
        $request->validate([
            "category_name_en" => 'required',
            "category_name_ar" => 'required',
            "category_icon" => 'required',
        ],[
            "category_name_en.required" => "Input Category English Name",
            "category_name_ar.required" => "Input Category Arabic Name",
        ]);
        
        // insert brand to the database
        Category::insert([
            "category_name_en" => $request->category_name_en,
            "category_name_ar" => $request->category_name_ar,
            "category_slug_en" => strtolower(str_replace(' ','-', $request->category_name_en)),
            "category_slug_ar" => str_replace(' ','-', $request->category_name_ar),
            "category_icon" => $request->category_icon,
            "created_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "Category has been added successfully",
            "alert-type" => "success",
        );
        return Redirect()->back()->with($notification);
    }
    public function CategoryEdit($id){
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    // Update category
    public function CategoryUpdate(Request $request){
        $request->validate([
            "category_name_en" => 'required',
            "category_name_ar" => 'required',
            "category_icon" => 'required',
        ],[
            "category_name_en.required" => "Input Category English Name",
            "category_name_ar.required" => "Input Category Arabic Name",
        ]);
        Category::findOrFail($request->id)->update([
            "category_name_en" => $request->category_name_en,
            "category_name_ar" => $request->category_name_ar,
            "category_slug_en" => strtolower(str_replace(' ','-', $request->category_name_en)),
            "category_slug_ar" => str_replace(' ','-', $request->category_name_ar),
            "category_icon" => $request->category_icon,
            "updated_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "Category has been updated successfully",
            "alert-type" => "info",
        );
        return Redirect()->route('all.category')->with($notification);
    }
    // delete Category
    public function CategoryDelete($id){
        Category::findOrFail($id)->delete();
        $notification = array(
            "message" => "Category has been updated successfully",
            "alert-type" => "success",
        );
        return redirect()->back()->with($notification);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Category;
use Illuminate\Support\Carbon;

class SubCategoryConroller extends Controller
{
    //
    public function SubCategoryView(){
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategory = SubCategory::latest()->get();
        return view('backend.category.subcategory_view', compact('subcategory','categories'));
    }
    public function SubCategoryStore(Request $request){
        $request->validate([
            "subcategory_name_en" => 'required',
            "subcategory_name_ar" => 'required',
            "category_id" => 'required',
        ],[
            "subcategory_name_en.required" => "Input Category English Name",
            "subcategory_name_ar.required" => "Input Category Arabic Name",
        ]);
        
        // insert brand to the database
        SubCategory::insert([
            "subcategory_name_en" => $request->subcategory_name_en,
            "subcategory_name_ar" => $request->subcategory_name_ar,
            "subcategory_slug_en" => strtolower(str_replace(' ','-', $request->subcategory_name_en)),
            "subcategory_slug_ar" => str_replace(' ','-', $request->subcategory_name_ar),
            "category_id" => $request->category_id,
            "created_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "SubCategory has been added successfully",
            "alert-type" => "success",
        );
        return Redirect()->back()->with($notification);
    }
    public function SubCategoryEdit($id){
            $subcategory = SubCategory::findOrFail($id);
            $categories = Category::orderBy('category_name_en', 'ASC')->get();
            return view('backend.category.subcategory_edit', compact('subcategory','categories'));
    }

    public function SubCategoryUpdate(Request $request){
        $subject_id = $request->id;
        $request->validate([
            "subcategory_name_en" => 'required',
            "subcategory_name_ar" => 'required',
            "category_id" => 'required',
        ],[
            "subcategory_name_en.required" => "Input Category English Name",
            "subcategory_name_ar.required" => "Input Category Arabic Name",
        ]);
        
        // insert brand to the database
        SubCategory::findOrFail($subject_id)->update([
            "subcategory_name_en" => $request->subcategory_name_en,
            "subcategory_name_ar" => $request->subcategory_name_ar,
            "subcategory_slug_en" => strtolower(str_replace(' ','-', $request->subcategory_name_en)),
            "subcategory_slug_ar" => str_replace(' ','-', $request->subcategory_name_ar),
            "category_id" => $request->category_id,
            "updated_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "SubCategory has been Updated successfully",
            "alert-type" => "info",
        );
        return Redirect()->route('all.subcategory')->with($notification);
    }

    public function SubCategoryDelete($id){
        SubCategory::findOrFail($id)->delete();
        $notification = array(
            "message" => "SubCategory has been updated successfully",
            "alert-type" => "success",
        );
        return redirect()->back()->with($notification);
    }

    ///////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////
    //////////////////////SubSubCateogry Routes ///////////////
    ///////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////
    
    public function SubSubCategoryView(){
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subsubcategory = SubSubCategory::latest()->get();
        return view('backend.category.sub_subcategory_view', compact('subsubcategory','categories'));
    }

    // ajax
    public function GetSubcategory($category_id){
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($subcat);
    }

    // sub subcategory
    public function GetSubSubcategory($subcategory_id){
        $subsubcat = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name_en', 'ASC')->get();
        return json_encode($subsubcat);
    }

    // end ajax functions

    public function SubSubCategoryStore(Request $request){
        $request->validate([
            "subsubcategory_name_en" => 'required',
            "subsubcategory_name_ar" => 'required',
            "category_id" => 'required',
            
        ],[
            "subsubcategory_name_en.required" => "Input Category English Name",
            "subsubcategory_name_ar.required" => "Input Category Arabic Name",
        ]);
        
        // insert brand to the database
        SubSubCategory::insert([
            "subsubcategory_name_en" => $request->subsubcategory_name_en,
            "subsubcategory_name_ar" => $request->subsubcategory_name_ar,
            "subsubcategory_slug_en" => strtolower(str_replace(' ','-', $request->subsubcategory_name_en)),
            "subsubcategory_slug_ar" => str_replace(' ','-', $request->subsubcategory_name_ar),
            "category_id" => $request->category_id,
            "subcategory_id" => $request->subcategory_id,
            "created_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "SubSubCategory has been added successfully",
            "alert-type" => "success",
        );
        return Redirect()->back()->with($notification);
    }

    // edit sub sub category
    public function SubSubCategoryEdit($id){
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en', 'ASC')->get();
        $subsubcategory = SubSubCategory::findOrFail($id);
        return view('backend.category.sub_subcategory_edit', compact('subsubcategory','subcategories','categories'));
    }
    // update route
    public function SubSubCategoryUpdate(Request $request){
        $request->validate([
            "subsubcategory_name_en" => 'required',
            "subsubcategory_name_ar" => 'required',
            "category_id" => 'required',
            
        ],[
            "subsubcategory_name_en.required" => "Input Category English Name",
            "subsubcategory_name_ar.required" => "Input Category Arabic Name",
        ]);
        
        // insert brand to the database
        SubSubCategory::findOrFail($request->id)->update([
            "subsubcategory_name_en" => $request->subsubcategory_name_en,
            "subsubcategory_name_ar" => $request->subsubcategory_name_ar,
            "subsubcategory_slug_en" => strtolower(str_replace(' ','-', $request->subsubcategory_name_en)),
            "subsubcategory_slug_ar" => str_replace(' ','-', $request->subsubcategory_name_ar),
            "category_id" => $request->category_id,
            "subcategory_id" => $request->subcategory_id,
            "created_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "SubSubCategory has been updateded successfully",
            "alert-type" => "success",
        );
        return Redirect()->route("all.subsubcategory")->with($notification);
    }
    // delete method
    public function SubSubCategoryDelete($id){
        SubSubCategory::findOrFail($id)->delete();
        $notification = array(
            "message" => "SubSubCategory has been deleted successfully",
            "alert-type" => "info",
        );
        return Redirect()->back()->with($notification);
    }
}

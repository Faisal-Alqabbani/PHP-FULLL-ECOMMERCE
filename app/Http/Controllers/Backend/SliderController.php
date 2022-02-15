<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;


class SliderController extends Controller
{
    //
    public function SliderView(){
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_view', compact('sliders'));
    }

    public function SliderStore(Request $request){
        $request->validate([
            "slider_img" => 'required',
        ],[
            "slider_img.required" => "Please Select One Image",
        ]);
        $image = $request->file('slider_img');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // resize the image with its width and height;
        Image::make($image)->resize(870,370)->save('upload/slider/'.$name_gen);
        // save url to save it in the database
        $save_url = 'upload/slider/'.$name_gen;
        
        // insert brand to the database
        Slider::insert([
            "title" => $request->title,
            "description" => $request->description,
            "slider_img" => $save_url,
            "created_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "Slider has been added",
            "alert-type" => "success",
        );
        return Redirect()->back()->with($notification);

    }
    
    // edit Slider
    public function SliderEdit($id){
        $slider = Slider::findOrFail($id);
        return view('backend.slider.edit_slider', compact('slider'));
    }
    
    // update 
    public function SliderUpdate(Request $request){
        $slider_id = $request->id;
        $old_image = $request->old_image;
        if ($request->file('slider_img')) {
        unlink($old_image);
        $image = $request->file('slider_img');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // resize the image with its width and height;
        Image::make($image)->resize(300,300)->save('upload/slider/'.$name_gen);
        // save url to save it in the database
        $save_url = 'upload/slider/'.$name_gen;
        
        // insert slider to the database
        Slider::findOrFail($slider_id)->update([
            "title" => $request->title,
            "description" => $request->description,
            "slider_img" => $save_url,
            "updated_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "Slider has been updated successfully",
            "alert-type" => "success",
        );
        return Redirect()->route('manage-slider')->with($notification);

        } // end if.
        else{
             // insert brand to the database
        Slider::findOrFail($slider_id)->update([
            "title" => $request->title,
            "description" => $request->description,
            "slider_img" => $old_image,
            "updated_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "Slider has been updated successfully",
            "alert-type" => "success",
        );
        return Redirect()->route('manage-slider')->with($notification);

        } // end else
    }
    
    public function SliderDelete($id){
        $slider = Slider::findOrFail($id);
        $img = $slider->slider_img;
        unlink($img);
        Slider::findOrFail($id)->delete();
        $notification = array(
            "message" => "Slider has been updated successfully",
            "alert-type" => "info",
        );
        return Redirect()->back()->with($notification);
    }

     // Slider InActive
     public function SliderInactive($id){
        Slider::findOrFail($id)->update([
            'status' => 0,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            "message" => "InActivted Your Slider Successfully!",
            "alert-type" => "info",
        );
        return Redirect()->back()->with($notification); 
    }

    public function SliderActive($id){
        Slider::findOrFail($id)->update([
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            "message" => "Activated Your Slider Successfully!",
            "alert-type" => "info",
        );
        return Redirect()->back()->with($notification);   
    }
}

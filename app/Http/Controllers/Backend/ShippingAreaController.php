<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use Illuminate\Support\Carbon;
class ShippingAreaController extends Controller
{
    //
    public function DivisionView(){
        $divisions = ShipDivision::orderBy('id', 'DESC')->get();
        return view('backend.ship.division.view_division', compact('divisions'));
    }

    public function DivisionStore(Request $request){
        $request->validate([
            "division_name" => 'required',
        ]);
        
        // insert brand to the database
        ShipDivision::insert([
            "division_name" => $request->division_name,
            "created_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "Division added successfully!",
            "alert-type" => "success",
        );
        return Redirect()->back()->with($notification);
    }
    
    public function DivisionEdit($id){
        $division = ShipDivision::findOrFail($id);
        return view('backend.ship.division.edit_view', compact('division'));
    }
    // division Edit
    public function DivisionUpdate(Request $request, $id){
        $request->validate([
            "division_name" => 'required',
        ]);
        
        // insert brand to the database
        ShipDivision::findOrFail($id)->update([
            "division_name" => $request->division_name,
            "updated_at" => Carbon::now(),
        ]);
        
        $notification = array(
            "message" => "Division updated successfully!",
            "alert-type" => "success",
        );
        return Redirect()->route('manage-division')->with($notification);
  
    }

    // delete 
    public function DivisionDelete($id){
        ShipDivision::findOrFail($id)->delete(); 
        $notification = array(
            "message" => "Division deleted successfully!",
            "alert-type" => "info",
        );
        return Redirect()->back()->with($notification);
    }


    // start District routes
    public function DistrictView(){
        $districts = ShipDistrict::with('division')->orderBy('id', 'DESC')->get();
        $divisions = ShipDivision::orderBy('id', 'DESC')->get();
        return view('backend.ship.district.view_district', compact('districts', 'divisions'));
    } 

    public function DistrictStore(Request $request){
        $request->validate([
            "district_name" => 'required',
            "division_id" => 'required',
        ]);
        
        // insert brand to the database
        ShipDistrict::insert([
            "district_name" => $request->district_name,
            "division_id" => $request->division_id,
            "created_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "Division added successfully!",
            "alert-type" => "success",
        );
        return Redirect()->back()->with($notification);
    }
    
    public function DistrictEdit($id){
        $district = ShipDistrict::findOrFail($id);
        $divisions = ShipDivision::orderBy('id', 'DESC')->get();  
        return view('backend.ship.district.edit_district', compact('district', 'divisions')); 

    }
    // End District
    public function DistrictUpdate(Request $request, $id){
        $request->validate([
            "district_name" => 'required',
            "division_id" => 'required',
        ]);
        
        // insert brand to the database
        ShipDistrict::findOrFail($id)->update([
            "district_name" => $request->district_name,
            "division_id" => $request->division_id,
            "updated_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "Division added successfully!",
            "alert-type" => "success",
        );
        return Redirect()->route('manage-district')->with($notification);
   
    }

    public function DistrictDelete($id){
        ShipDistrict::findOrFail($id)->delete(); 
        $notification = array(
            "message" => "District deleted successfully!",
            "alert-type" => "info",
        );
        return Redirect()->back()->with($notification);
    }

    // shpping state
    public function StateView(){
        $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $state = ShipState::orderBy('id', 'DESC')->get();
        return view('backend.ship.state.view_state', compact('districts', 'divisions', 'state'));
    }
    // State Store
    public function StateStore(Request $request){
        $request->validate([
            "state_name" => 'required',
            "district_id" => 'required',
            "division_id" => 'required',
        ]);
        
        // insert brand to the database
        ShipState::insert([
            "state_name" => $request->state_name,
            "district_id" => $request->district_id,
            "division_id" => $request->division_id,
            "created_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "State has added successfully!",
            "alert-type" => "success",
        );
        return Redirect()->back()->with($notification);
    }

    public function StateEdit($id){
        $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $state = ShipState::findOrFail($id);
        return view('backend.ship.state.state_edit', compact('districts', 'divisions', 'state'));
    }

    public function StateUpdate(Request $request, $id){
        $request->validate([
            "state_name" => 'required',
            "district_id" => 'required',
            "division_id" => 'required',
        ]);
        
        // insert brand to the database
        ShipState::findOrFail($id)->update([
            "state_name" => $request->state_name,
            "district_id" => $request->district_id,
            "division_id" => $request->division_id,
            "updated_at" => Carbon::now(),
        ]);
        $notification = array(
            "message" => "State has updateda successfully!",
            "alert-type" => "info",
        );
        return Redirect()->route('manage-state')->with($notification);
    }

    
    public function StateDelete($id){
        ShipState::findOrFail($id)->delete(); 
        $notification = array(
            "message" => "State deleted successfully!",
            "alert-type" => "info",
        );
        return Redirect()->back()->with($notification);
    }




    // ajax
    public function DistrictAjax($division_id){
        $districts = ShipDistrict::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return response()->json($districts);
    }

    public function StateAjax($district_id){
        $state = ShipState::where('district_id', $district_id)->orderBy('state_name', 'ASC')->get();
        return response()->json($state);
    }
}

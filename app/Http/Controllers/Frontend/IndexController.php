<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Brand;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    //
    public function index(){
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $porducts = Product::where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $featured = Product::where('featured',1)->orderBy('id', 'DESC')->limit(6)->get();
        $hot_deals = Product::where('hot_deals',1)->where('discount_price','!=','NULL')->orderBy('id', 'DESC')->limit(3)->get();
        $spicial_offer = Product::where('spicial_offer',1)->orderBy('id', 'DESC')->limit(3)->get();
        $spicial_deal = Product::where('spicial_deal',1)->orderBy('id', 'DESC')->limit(3)->get();
        // get Products by Cateogries.
        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->limit(6)->get();
        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status',1)->where('category_id',$skip_category_1->id)->orderBy('id','DESC')->limit(6)->get(); 
        // getProducts By Brand
        $skip_brand_1 = Brand::skip(2)->first();
        $skip_brand_product_1 = Product::where('status',1)->where('brand_id',$skip_brand_1->id)->orderBy('id','DESC')->limit(6)->get();
        
        return view('frontend.index', compact('categories','sliders', 'porducts', 'featured', 'hot_deals','spicial_offer', 'spicial_deal','skip_category_0','skip_product_0'
        ,'skip_category_1','skip_product_1','skip_brand_1','skip_brand_product_1' 
    ));
    }
    // logout 
    public function UserLogout(){
        Auth::logout();
        return redirect()->route('login');
        
    }
    // user profile function
    public function UserProfile(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile', compact('user'));
    }
    // update Profile 
    public function UserProfileStore(Request $request){
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        if($request->file('profile_photo_path')){
            #code ...
            $file = $request->file('profile_photo_path');
            // because its empty
            if($data['profile_photo_path']){
                @unlink(public_path('upload/user_images/'.$data['profile_photo_path'])); 
            }
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename); 
            $data['profile_photo_path'] = $filename;
        }
        $data->save();
        $notification = array(
            'message' => 'User Profile has updated successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard')->with($notification);
        
    } // End Method!

    // change User password
    public function ChangeUserPassword(){ 
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.change_password', compact('user'));
    }
    public function UserPasswordUpdate(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',   
        ]);
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save(); 
            Auth::logout();
            $notification = array(
                'message' => 'Your password has been updated successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('user.logout')->with($notification);
            
        }else{
            return redirect()->back();
        }
    }
    // end method
    public function ProductDetails($id,$slug){
        $product = Product::findOrFail($id);
        $multi_image = MultiImg::where('product_id', $product->id)->get();
        $color_en = $product->product_color_en;
        $product_color_en = explode(',', $color_en);
        // Arabic colors 
        $color_ar = $product->product_color_ar;
        $product_color_ar = explode(',', $color_ar);

        // product size english
        $size_en = $product->product_size_en;
        $product_size_en = explode(',', $size_en);
    
        //Another way of passing data insted of using compact.
        // $data['size_en'] = $product->product_size_en;
        // $data['product_size_en'] = expload(',', $size_en);
        // Arabic sizes 
        $size_ar = $product->product_size_ar;
        $product_size_ar = explode(',', $size_ar);
        // get category id
        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$product->id)->orderBy('id', 'DESC')->get();
        return view('frontend.product.product_details', compact('product','multi_image', 'product_color_en','product_color_ar','product_size_en','product_size_ar','relatedProduct'));
        
    }

    // tag routes
    public function TagWiseProduct($tag){
        $products = Product::where('status', 1)->where('product_tags_en',$tag)->orderBy('id', 'DESC')->paginate(9);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('frontend.tags.tag_view', compact('products','categories'));
    }


    // category products
    public function SubCatWiseProduct($subcat_id, $slug){
        $products = Product::where('status', 1)->where('subcategory_id', $subcat_id)->orderBy('id', 'DESC')->paginate(9);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('frontend.product.subcategory_view', compact('products','categories')); 
    }

    public function SubSubCatWiseProduct($subsubcat_id, $slug){
        $products = Product::where('status', 1)->where('subsubcategory_id', $subsubcat_id)->orderBy('id', 'DESC')->paginate(9);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('frontend.product.sub_subcategory_view', compact('products','categories')); 
    }


    // product view model with ajax
    public function ProductViewModel($id){
        // with mean passing brand,cateogry with all response
        $product = Product::with('category','brand')->findOrFail($id);
        $color = $product->product_color_en;
        $product_color = explode(',', $color);
        //  get Product size
        $size = $product->product_size_en;
        $product_size = explode(',', $size);
        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
        ));
    } // end method
}

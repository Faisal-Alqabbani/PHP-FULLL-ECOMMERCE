@extends('admin.admin_master')
@section('admin')

<div class="content">
    <div class="row">
    
   
   {{-- second col --}}
   <div class="col-md-12">

    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">Add SubCategory</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="container">
            <form method="post" action="{{route('subcategory.update')}}">
                @csrf
                 <div class="row">
                           {{-- col one --}}
                        <input type="hidden" name="id" value={{$subcategory->id}}>
                        <div class="col-md-12">

                            <div class="form-group">
								<h5>Basic Select <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="category_id" class="form-control">
										<option value="" selected="" disabled="">Select Your City</option>
                                        @foreach($categories as $cat)
										<option value="{{($cat->id)}}" {{($cat->id == $subcategory->id)? 'selected':''}}>{{$cat->category_name_en}}</option>
                                        @endforeach
									</select>
                                    @error('category_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
							</div>
                            <div class="form-group">
                                <h5>SubCategory Name English <span class="text-danger">*</span></h5>
                                <input type="text" value="{{$subcategory->subcategory_name_en}}" name="subcategory_name_en" class="form-control">
                                @error('subcategory_name_en')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                          
                            </div>
                            <div class="form-group">
                                <h5>SubCategory Name Arabic <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type="text" value="{{$subcategory->subcategory_name_ar}}"  name="subcategory_name_ar" class="form-control"  data-validation-required-message="This field is required">
                                @error('subcategory_name_ar')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div>                     
                       </div>
                        {{-- second row in with input file and image --}}
                    
                   <div class="text-xs-right">
                       <input type="submit" value="Update" class="btn btn-primary btn-rounded mb-5">
                   </div>
               </form>
           </div>
       </div>
       <!-- /.box-body -->
     </div>
     <!-- /.box -->
     <!-- /.box -->          
   </div>





   
    </div>
</div>
@endsection
@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="content">
    <div class="row">
   
   {{-- second col --}}
   <div class="col-12">

    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">Add Sub->SubCategory</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="container">
            <form method="post" action="{{route('subsubcategory.update')}}">
                @csrf
                <input type="hidden" name="id" value="{{$subsubcategory->id}}">

                            <div class="form-group">
								<h5>Category <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="category_id" class="form-control">
										<option value="" selected="" disabled="">Select Your Category</option>
                                        @foreach($categories as $cat)
										<option value="{{$cat->id}}" {{($cat->id == $subsubcategory->category_id) ? 'selected': ''}}>{{$cat->category_name_en}}</option>
                                        @endforeach
									</select>
                                    @error('category_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
							</div>
                            {{-- another selector --}}
                            <div class="form-group">
								<h5>SubCategory Select <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="subcategory_id" class="form-control">
										<option value="" selected="" disabled="">Select Your Category</option>
                                        @foreach($subcategories as $cat)
										<option value="{{$cat->id}}" {{($cat->id == $subsubcategory->subcategory_id) ? 'selected': ''}}>{{$cat->subcategory_name_en}}</option>
                                        @endforeach
                                     
									</select>
                                    @error('category_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
							</div>
                            <div class="form-group">
                                <h5>Sub-SubCategory Name English <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type="text" value="{{$subsubcategory->subsubcategory_name_en}}" name="subsubcategory_name_en" class="form-control"  data-validation-required-message="This field is required">
                                @error('subsubcategory_name_en')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div>
                            <div class="form-group">
                                <h5>Sub-SubCategory Name Arabic <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type="text" value="{{$subsubcategory->subsubcategory_name_ar}}" name="subsubcategory_name_ar" class="form-control"  data-validation-required-message="This field is required">
                                @error('subsubcategory_name_ar')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div>                     
                  
                        {{-- second row in with input file and image --}}
                    
                   <div class="text-xs-right">
                       <input type="submit" value="Update" class="btn btn-primary btn-rounded mb-5">
               
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
@extends('admin.admin_master')
@section('admin')

<div class="content">
    <div class="row">
        
     
   {{-- second col --}}
   <div class="col-md-12">

    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">Update Category</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div>
            <form method="post" action="{{route('category.update')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name='id' value={{$category->id}}>
                 <div class="row">
                           {{-- col one --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Category Name English <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input value="{{$category->category_name_en}}" type="text" name="category_name_en" class="form-control"  data-validation-required-message="This field is required">
                                @error('category_name_en')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div>

                            <div class="form-group">
                                <h5>Category Name Arabic<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" value="{{$category->category_name_ar}}" name="category_name_ar" class="form-control"  data-validation-required-message="This field is required">
                                    @error('category_name_ar')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Category Icon<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" value="{{$category->category_icon}}"" name="category_icon" class="form-control"  data-validation-required-message="This field is required">
                                    @error('category_icon')
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
@extends('admin.admin_master')
@section('admin')

<div class="content">
    <div class="row">
        
     
   {{-- second col --}}
   <div class="col-md-12">

    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">Edit Brand</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="table-responsive">
            <form method="post" action="{{route('brand.update')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name='id' value={{$brand->id}}>
                <input type="hidden" name="old_image" value={{$brand->brand_image}}>
                 <div class="row">
                           {{-- col one --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Brand Name English <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input value="{{$brand->brand_name_en}}" type="text" name="brand_name_en" class="form-control"  data-validation-required-message="This field is required">
                                @error('brand_name_en')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div>

                            <div class="form-group">
                                <h5>Brand Name Arabic<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" value="{{$brand->brand_name_ar}}" name="brand_name_ar" class="form-control"  data-validation-required-message="This field is required">
                                    @error('brand_name_ar')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Brand Image<span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type='file' name="brand_image" class="form-control"  data-validation-required-message="This field is required">
                                @error('brand_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
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
@extends('admin.admin_master')
@section('admin')

<div class="content">
    <div class="row">
        
     
   {{-- second col --}}
   <div class="col-md-12">

    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">Edit Slider</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="table-responsive">
            <form method="post" action="{{route('slider.update')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name='id' value={{$slider->id}}>
                <input type="hidden" name="old_image" value={{$slider->slider_img}}>
                 <div class="row">
                           {{-- col one --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Slider Title</h5>
                                <div class="controls">
                                <input value="{{$slider->title}}" type="text" name="title" class="form-control"  data-validation-required-message="This field is required">
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div>

                            <div class="form-group">
                                <h5>Slider Description<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" value="{{$slider->description}}" name="description" class="form-control"  data-validation-required-message="This field is required">
                                    @error('brand_name_ar')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Slider Image<span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type='file' name="slider_img" class="form-control"  data-validation-required-message="This field is required">
                                @error('slider_img')
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
@extends('admin.admin_master')
@section('admin')

<div class="content">
    <div class="row">
        
        <div class="col-md-8">

    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">Slider List</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="table-responsive">
             <table id="example1" class="table table-bordered table-striped">
               <thead>
                   <tr>
                       <th>Slider Title</th>
                       <th>Slider Description</th>
                       <th>Slider Image</th>
                       <th>Status</th>
                       <th>Action</th>
                
                   </tr>
               </thead>
               <tbody>
                   @foreach($sliders as $item)
                   <tr>
                       <td>
                           {{$item->title}}
                           @if($item->title == NULL)
                           <span class="badge badge-pill badge-danger">No Title</span>
                          @else
                          {{$item->title}}
                          @endif
                        </td>
                       <td>{{$item->description}}</td>
                       <td><img src="{{asset($item->slider_img)}}" alt="" style="width:70px; height:40px;"></td>
                       <td>
                       @if($item->status == 1)
                       <span class="badge badge-pill badge-success">Active</span>
                      @else
                        <span class="badge badge-pill badge-danger">InActive</span>
                      @endif
                       </td>
                       <td>
                           <a href="{{ route('slider.edit',$item->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                           <a href="{{ route('slider.delete',$item->id) }}" id='delete' class="btn btn-danger btn-sm" title="Delete Data"><i class="fa fa-trash"></i></a>
                           @if($item->status == 1)
                           <a href="{{route('slider.inactive',$item->id)}}" class="btn btn-danger btn-sm" title="InAcive Now"><i class="fa fa-arrow-down"></i></a>
                          @else
                          <a href="{{route('slider.active',$item->id)}}" class="btn btn-success btn-sm" title="Active now"><i class="fa fa-arrow-up"></i></a>
                          @endif
                       </td>
                   </tr>
                   @endforeach
               </tbody>
          
             </table>
           </div>
       </div>
       <!-- /.box-body -->
     </div>
     <!-- /.box -->
     <!-- /.box -->          
   </div>
   
   {{-- second col --}}
   <div class="col-md-4">

    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">Add Slider</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="table-responsive">
            <form method="post" action="{{route('slider.store')}}" enctype="multipart/form-data">
                @csrf
                 <div class="row">
                           {{-- col one --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Title</h5>
                                <div class="controls">
                                <input type="text" name="title" class="form-control"  data-validation-required-message="This field is required">
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div>

                            <div class="form-group">
                                <h5>Sldier Description</h5>
                                <div class="controls">
                                    <input type="text" name="description" class="form-control"  data-validation-required-message="This field is required">
                                    @error('brand_name_ar')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Slider Image<span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type='file' name="slider_img" class="form-control" required=""  data-validation-required-message="This field is required">
                                @error('slider_img')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                       </div>
                        {{-- second row in with input file and image --}}
                    
                   <div class="text-xs-right">
                       <input type="submit" value="Add Slider" class="btn btn-primary btn-rounded mb-5">
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
@extends('admin.admin_master')
@section('admin')
   {{-- second col --}}
   <div class="col-md-12 my-2">

    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">Add Coupon</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="container">
            <form method="post" action="{{route('division.update',$division->id)}}">
                @csrf
                 <div class="row">
                           {{-- col one --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Divsion Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type="text" name="division_name" class="form-control" value="{{$division->division_name}}"  data-validation-required-message="This field is required">
                                @error('division_name')
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








@endsection
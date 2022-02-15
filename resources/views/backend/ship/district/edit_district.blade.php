@extends('admin.admin_master')
@section('admin')
<div class="col-md-12 my-3">

    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">Update District</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="container">
            <form method="post" action="{{route('district.update',$district->id)}}">
                @csrf
                 <div class="row">
                           {{-- col one --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Division Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <select class="form-control" name="division_id">
                                    
                                    
                                    @foreach($divisions as $item)
                                    @if($item->id == $district->division_id)
                                    <option value="{{$item->id}}" selected="">{{$item->division_name}}</option>
                                    @else
                                    <option value="{{$item->id}}">{{$item->division_name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('division_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>District Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type="text" name="district_name" value="{{$district->district_name}}" class="form-control"  data-validation-required-message="This field is required">
                                @error('district_name')
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
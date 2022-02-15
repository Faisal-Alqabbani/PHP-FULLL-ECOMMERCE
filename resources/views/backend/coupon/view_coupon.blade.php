@extends('admin.admin_master')
@section('admin')

<div class="content">
    <div class="row">
        
        <div class="col-md-8">

    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">Coupons List</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="table-responsive">
             <table id="example1" class="table table-bordered table-striped">
               <thead>
                   <tr>
                        <th>Coupon Name</th>
                       <th>Coupon Discount</th>
                       <th>Coupon Validity</th>
                       <th>Status</th>
                       <th>Action</th>
                
                   </tr>
               </thead>
               <tbody>
                   @foreach($coupons as $item)
                   <tr>
                       <td>{{$item->coupon_name}}</td>
                       <td>{{$item->coupon_discount}}%</td>
                       <td>
                        {{Carbon\Carbon::parse($item->coupon_validity)->format('D,d F Y')}}  
                        </td>       
                       <td>
                        @if($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                        <span class="badge badge-pill badge-success">Valid</span>
                       @else
                         <span class="badge badge-pill badge-danger">In Valid</span>
                       @endif    
                       </td>         
                       <td>
                        <a href="{{route('coupon.edit',$item->id)}}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                        <a href="{{route('coupon.delete',$item->id)}}" id='delete' class="btn btn-danger" title="Delete Data"><i class="fa fa-trash"></i></a>

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
         <h3 class="box-title">Add Coupon</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="container">
            <form method="post" action="{{route('coupon.store')}}">
                @csrf
                 <div class="row">
                           {{-- col one --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Coupon Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type="text" name="coupon_name" class="form-control"  data-validation-required-message="This field is required">
                                @error('coupon_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div>
                            <div class="form-group">
                                <h5>Coupon Discount(%) <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type="text" name="coupon_discount" class="form-control"  data-validation-required-message="This field is required">
                                @error('coupon_discount')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div>

                            <div class="form-group">
                                <h5>Coupon Validity Date<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="date" name="coupon_validity" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control"  data-validation-required-message="This field is required">
                                    @error('coupon_validity')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                       
                       </div>
                        {{-- second row in with input file and image --}}
                    
                   <div class="text-xs-right">
                       <input type="submit" value="Add New Coupon" class="btn btn-primary btn-rounded mb-5">
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
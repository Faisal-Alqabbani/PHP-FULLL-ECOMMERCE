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
            <form method="post" action="{{route('coupon.update',$coupon->id)}}">
                @csrf
                 <div class="row">
                           {{-- col one --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Coupon Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type="text" name="coupon_name" class="form-control" value="{{$coupon->coupon_name}}"  data-validation-required-message="This field is required">
                                @error('coupon_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div>
                            <div class="form-group">
                                <h5>Coupon Discount(%) <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type="text" name="coupon_discount" value="{{$coupon->coupon_discount}}" class="form-control"  data-validation-required-message="This field is required">
                                @error('coupon_discount')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div>

                            <div class="form-group">
                                <h5>Coupon Validity Date<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="date" name="coupon_validity" value="{{$coupon->coupon_validity}}" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control"  data-validation-required-message="This field is required">
                                    @error('coupon_validity')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                       
                       </div>
                        {{-- second row in with input file and image --}}
                    
                   <div class="text-xs-right">
                       <input type="submit" value="Update Coupon" class="btn btn-primary btn-rounded mb-5">
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
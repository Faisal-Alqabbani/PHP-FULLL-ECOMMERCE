@extends('admin.admin_master')
@section('admin')
<section class="content">
    <!-- Basic Forms -->
     <div class="box">
       <div class="box-header with-border">
         <h4 class="box-title">Change Password</h4>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
         <div class="row">
           <div class="col">
               <form method="post" action="{{route('update.change.password')}}">
                @csrf
                 <div class="row">
                   <div class="col-12">	
                       <div class="row">
                           {{-- col one --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Current Password <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="password" id="current_password" name="oldpassword" class="form-control" required="" data-validation-required-message="This field is required"></div>
                            </div>

                            <div class="form-group">
                                <h5>New Password<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="password" name="password" class="form-control" required="" data-validation-required-message="This field is required"></div>
                            </div>
                            <div class="form-group">
                                <h5>Confirm Password<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type='password' id="password_confirmation" type="password_confirmation" name="password_confirmation" class="form-control" required="" data-validation-required-message="This field is required"></div>
                            </div>
                            
                        </div>
                       </div>
                        {{-- second row in with input file and image --}}
                    
                   <div class="text-xs-right">
                       <input type="submit" value="Change Password" class="btn btn-primary btn-rounded mb-5">
                   </div>
               </form>

           </div>
           <!-- /.col -->
         </div>
         <!-- /.row -->
       </div>
       <!-- /.box-body -->
     </div>
     <!-- /.box -->

   </section>
   @endsection
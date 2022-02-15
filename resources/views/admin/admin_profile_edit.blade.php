@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content">
    <!-- Basic Forms -->
     <div class="box">
       <div class="box-header with-border">
         <h4 class="box-title">Profile Admin Edit</h4>
       
       </div>
       <!-- /.box-header -->
       <div class="box-body">
         <div class="row">
           <div class="col">
               <form method="post" action="{{route('admin.profile.store')}}" enctype="multipart/form-data">
                @csrf
                 <div class="row">
                   <div class="col-12">	
                       <div class="row">
                           {{-- col one --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Admin User Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" value="{{$editData->name}}" name="name" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                            </div>
                            
                        </div>
                        {{-- col two --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Admin User Email <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="email" value="{{$editData->email}}" name="email" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                            </div>
                        </div>
                        </div>	
                        
                        {{-- second row in with input file and image --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Profile Image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" id="image" name="profile_photo_path" class="form-control"> <div class="help-block"></div></div>
                                </div>
                            </div>
                            {{-- col image --}}
                            <div class="col-md-6">
                                <img id="showImage"  src="{{(!empty($editData->profile_photo_path))? url('upload/admin_images/'.$editData->profile_photo_path): url('upload/no_image.jpg')}}" alt="" style="width:200px; height: 200px;" class='rounded'>
                            </div>
                        </div>
                     
                       
                    
                     
                       
                   <div class="text-xs-right">
                       <input type="submit" value="Update" class="btn btn-primary btn-rounded mb-5">
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
   <script type="text/javascript">
    $(document).ready(function(){
        $('#image').change((e) => {
            var reader = new FileReader();
            reader.onload = (e) => {
                $('#showImage').attr('src',e.target.result);
            };
            reader.readAsDataURL(e.target.files['0']);
        });
    })

    </script>
   @endsection
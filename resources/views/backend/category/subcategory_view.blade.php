@extends('admin.admin_master')
@section('admin')

<div class="content">
    <div class="row">
        
        <div class="col-md-8">

    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">Subcategory List</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="table-responsive">
             <table id="example1" class="table table-bordered table-striped">
               <thead>
                   <tr>
                        <th>Category</th>
                       <th>SubCategory Name English</th>
                       <th>SubCategory Name Arabic</th>
                       <th>Action</th>
                
                   </tr>
               </thead>
               <tbody>
                   @foreach($subcategory as $item)
                   <tr>
                       {{-- I got this from Subcategory class --}}
                       <td>{{$item->category->category_name_en}}</td>
                       <td>{{$item->subcategory_name_en}}</td>
                       <td>{{$item->subcategory_name_ar}}</td>                
                       <td>
                           <a href="{{route('subcategory.edit',$item->id)}}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                        <a href="{{route('subcategory.delete',$item->id)}}" id='delete' class="btn btn-danger" title="Delete Data"><i class="fa fa-trash"></i></a>

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
         <h3 class="box-title">Add SubCategory</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="container">
            <form method="post" action="{{route('subcategory.store')}}">
                @csrf
                 <div class="row">
                           {{-- col one --}}
                        <div class="col-md-12">

                            <div class="form-group">
								<h5>Basic Select <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="category_id" class="form-control">
										<option value="" selected="" disabled="">Select Your City</option>
                                        @foreach($categories as $cat)
										<option value="{{$cat->id}}">{{$cat->category_name_en}}</option>
                                        @endforeach
									</select>
                                    @error('category_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
							</div>
                            <div class="form-group">
                                <h5>SubCategory Name English <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type="text" name="subcategory_name_en" class="form-control"  data-validation-required-message="This field is required">
                                @error('subcategory_name_en')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div>
                            <div class="form-group">
                                <h5>SubCategory Name Arabic <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type="text" name="subcategory_name_ar" class="form-control"  data-validation-required-message="This field is required">
                                @error('subcategory_name_ar')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div>                     
                       </div>
                        {{-- second row in with input file and image --}}
                    
                   <div class="text-xs-right">
                       <input type="submit" value="Add New" class="btn btn-primary btn-rounded mb-5">
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
@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="content">
    <div class="row">
        
        <div class="col-md-8">

    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">SubSubcategory List</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="table-responsive">
             <table id="example1" class="table table-bordered table-striped">
               <thead>
                   <tr>
                        <th>Category</th>
                       <th>SubCategory Name</th>
                       <th>Sub-Subcategory Name English</th>
                       <th>Action</th>
                
                   </tr>
               </thead>
               <tbody>
                   @foreach($subsubcategory as $item)
                   <tr>
                       {{-- I got this from Subcategory class --}}
                       <td>{{$item->category->category_name_en}}</td>
                       <td>{{$item->subcategory->subcategory_name_en}}</td>
                       <td>{{$item->subsubcategory_name_en}}</td>                
                       <td>
                           <a href="{{route('subsubcategory.edit',$item->id)}}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                        <a href="{{route('subsubcategory.delete',$item->id)}}" id='delete' class="btn btn-danger" title="Delete Data"><i class="fa fa-trash"></i></a>

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
         <h3 class="box-title">Add Sub->SubCategory</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="container">
            <form method="post" action="{{route('subsubcategory.store')}}">
                @csrf
                 <div class="row">
                           {{-- col one --}}
                        <div class="col-md-12">

                            <div class="form-group">
								<h5>Category <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="category_id" class="form-control">
										<option value="" selected="" disabled="">Select Your Category</option>
                                        @foreach($categories as $cat)
										<option value="{{$cat->id}}">{{$cat->category_name_en}}</option>
                                        @endforeach
									</select>
                                    @error('category_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
							</div>
                            {{-- another selector --}}
                            <div class="form-group">
								<h5>SubCategory Select <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="subcategory_id" class="form-control">
										<option value="" selected="" disabled="">Select Your Category</option>	
                                     
									</select>
                                    @error('category_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
							</div>
                            <div class="form-group">
                                <h5>Sub-SubCategory Name English <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type="text" name="subsubcategory_name_en" class="form-control"  data-validation-required-message="This field is required">
                                @error('subsubcategory_name_en')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div>
                            <div class="form-group">
                                <h5>Sub-SubCategory Name Arabic <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type="text" name="subsubcategory_name_ar" class="form-control"  data-validation-required-message="This field is required">
                                @error('subsubcategory_name_ar')
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


<script type="text/javascript">
$(document).ready(function(){
    $('select[name="category_id"]').on('change', function(){
        var category_id = $(this).val();
        if(category_id){
            $.ajax({
                url:"{{ url('/category/subcategory/ajax')}}/"+category_id,
                type:'GET',
                dataType:"json",
                success: function(data){
                    console.log(data);
                    var d = $("select[name='subcategory_id']").empty();
                    $.each(data, function(key, value){
                        $('select[name="subcategory_id"').append(`
                        <option value="${value.id}">${value.subcategory_name_en}</option>
                        `);
                    });
                }
            });
        }else{
            alert('danger');
        }
    });
});
</script>
@endsection
@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="content">
    <div class="row">
        
        <div class="col-md-8">

    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">State List</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="table-responsive">
             <table id="example1" class="table table-bordered table-striped">
               <thead>
                   <tr>
                        <th>Division Name</th>
                        <th>District Name</th>
                        <th>State Name</th>
                        <th>Action</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach($state as $item)
                   <tr>
                    <td>{{$item->division->division_name}}</td> 
                    <td>{{$item->district->district_name}}</td>  
                    <td >{{$item->state_name}}</td>  
                       <td>
                        <a href="{{route('state.edit',$item->id)}}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                        <a href="{{route('state.delete',$item->id)}}" id='delete' class="btn btn-danger" title="Delete Data"><i class="fa fa-trash"></i></a>

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
         <h3 class="box-title">Add State</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="container">
            <form method="post" action="{{route('state.store')}}">
                @csrf
                 <div class="row">
                           {{-- col one --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Division Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <select class="form-control" name="division_id">
                                    <option value="" selected="" disabled="">Select Division</option>
                                    @foreach($divisions as $item)
                                    <option value="{{$item->id}}">{{$item->division_name}}</option>
                                    @endforeach
                                </select>
                                @error('division_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <h5>District Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <select class="form-control" name="district_id">
                                    
                                </select>
                                @error('district_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <h5>State Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type="text" name="state_name" class="form-control"  data-validation-required-message="This field is required">
                                @error('state_name')
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

<script>
    $(document).ready(function(){
    $('select[name="division_id"]').on('change', function(){
        var division_id = $(this).val();
        if(division_id){
            $.ajax({
                url:"{{ url('/distict/ajax')}}/"+division_id ,
                type:'GET',
                dataType:"json",
                success: function(data){
                    console.log(data);
                    var d = $("select[name='district_id']").empty();
                    $.each(data, function(key, value){
                        $('select[name="district_id"').append(`
                        <option value="${value.id}">${value.district_name}</option>
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
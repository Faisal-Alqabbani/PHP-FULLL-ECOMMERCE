@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content">

    <!-- Basic Forms -->
     <div class="box">
       <div class="box-header with-border">
         <h4 class="box-title">Add Producta</h4>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
         <div class="row">
           <div class="col">
               <form method="post" action="{{route('product-store')}}" enctype="multipart/form-data">
                @csrf
                 <div class="row">
                   <div class="col-12">	
                       {{-- start first row --}}
                       <div class="row my-2"> 
                           {{-- start first col --}}
                        <div class="col-md-4">
                            <div class="form-group">
								<h5>Brands<span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="brand_id" class="form-control" required="">
										<option value="" selected="" disabled="">Select Your Brand</option>
                                        @foreach($brands as $brand)
										<option value="{{$brand->id}}">{{$brand->brand_name_en}}</option>
                                        @endforeach
									</select>
                                    @error('brand_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
							</div>
                        </div>
                            {{-- start second col --}}
                        <div class="col-md-4">
                            <div class="form-group">
								<h5>Category<span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="category_id" class="form-control" required="">
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
                        </div>
                            {{-- start Third col --}}
                        <div class="col-md-4">
                            <div class="form-group">
								<h5>SubCateogry<span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="subcategory_id" class="form-control" required="">
										<option value="" selected="" disabled="">Select Subcategory</option>
                                       
									</select>
                                    @error('category_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
							</div>
                        </div>
                        </div>					
                   
                       {{-- start second row --}}
                       <div class="row my-2"> 
                        {{-- start first col --}}
                     <div class="col-md-4">
                         <div class="form-group">
                             <h5>SubSubCategory<span class="text-danger">*</span></h5>
                             <div class="controls">
                                 <select name="subsubcategory_id" class="form-control" required="">
                                     <option value="" selected="" disabled="">Select Your Subsubcateogry</option>
                                    
                                 </select>
                                 @error('brand_id')
                                 <span class="text-danger">{{$message}}</span>
                                 @enderror
                             </div>
                         </div>
                     </div>
                         {{-- start second col --}}
                     <div class="col-md-4">
                        <div class="form-group">
                            <h5>Product Name English <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="product_name_en" class="form-control" required="" data-validation-required-message="This field is required"></div>
                
                            @error('product_name_en')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                     </div>
                         {{-- start Third col --}}
                     <div class="col-md-4">
                        <div class="form-group">
                            <h5>Product Name Arabic  <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="product_name_ar" class="form-control" required="" data-validation-required-message="This field is required"></div>
                
                            @error('product_name_ar')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                     </div>
                     </div>	
                     
                     {{-- start third row --}}
                       <div class="row my-2"> 
                        {{-- start first col --}}
                     <div class="col-md-4">
                        <div class="form-group">
                            <h5>Product Code <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="product_code" class="form-control" required="" data-validation-required-message="This field is required"></div>
                
                            @error('product_code')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                     </div>
                         {{-- start second col --}}
                     <div class="col-md-4">
                        <div class="form-group">
                            <h5>Quantitiy<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="product_qty" class="form-control" required="" data-validation-required-message="This field is required"></div>
                
                            @error('product_qty')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                     </div>
                         {{-- start Third col --}}
                     <div class="col-md-4">
                        <div class="form-group">
                            <h5>Product Tags English <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" required="" name="product_tags_en" class="form-control" value="Lorem,Ipsum,Amet" data-role="tagsinput" ></div>
                
                            @error('product_tags_en')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                     </div>
                     </div>	
                     
                     {{-- fourth colomn --}}
                      <div class="row my-2"> 
                        {{-- start first col --}}
                     <div class="col-md-4">
                        <div class="form-group">  
                            <h5>Product Tags Arabic <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" required="" name="product_tags_ar" class="form-control" value="Lorem,Ipsum,Amet" data-role="tagsinput" ></div>              
                            @error('product_tags_en')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                     </div>
                         {{-- start second col --}}
                     <div class="col-md-4">
                        <div class="form-group">  
                            <h5>Product Size Arabic</h5>
                            <div class="controls">
                                <input type="text" name="product_size_en" class="form-control" value="L,S,XL" data-role="tagsinput" ></div>              
                            @error('product_size_en')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                     </div>
                         {{-- start Third col --}}
                     <div class="col-md-4">
                        <div class="form-group">  
                            <h5>Product Size Arabic</h5>
                            <div class="controls">
                                <input type="text" name="product_size_ar" class="form-control" value="صغير" data-role="tagsinput" ></div>              
                            @error('product_size_ar')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                     </div>
                     </div>	   
                     
                     {{-- fifth Row --}}
                    {{-- fourth colomn --}}
                    <div class="row my-2"> 
                    {{-- start first col --}}
                    <div class="col-md-4">
                    <div class="form-group">  
                        <h5>Product Color English <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="product_color_en" required="" class="form-control" value="Red,Black,White" data-role="tagsinput" ></div>              
                        @error('product_color_en')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    </div>
                        {{-- start second col --}}
                    <div class="col-md-4">
                    <div class="form-group">  
                        <h5>Product Color Arabic<span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="product_color_ar" required="" class="form-control" value="احمر" data-role="tagsinput" ></div>              
                        @error('product_color_ar')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    </div>
                        {{-- start Third col --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Product Selling Price<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="number" name="selling_price" class="form-control" required="" data-validation-required-message="This field is required"></div>
                
                            @error('selling_price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    </div> 
                        

                        {{-- seventh --}}
                       
                        {{-- start first col --}}
                        
              

                 <div class="row my-2"> 
                    {{-- start first col --}}
                    <div class="col-md-4">
                 <div class="form-group">
                            <h5>Discount Price</h5>
                            <div class="controls">
                                <input type="number" name="discount_price" class="form-control" data-validation-required-message="This field is required"></div>
                
                            @error('discount_price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                        {{-- start second col --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Main Thumbnail<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="file" name="product_thmbnail" class="form-control" required="" onChange="mainThumUrl(this)"></div>
                        </div>
                        @error('product_thmbnail')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <img src="" id="mainThum" alt="">
                    </div>
                        {{-- start Third col --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Multi Image<span class="text-danger">*</span></h5>
                            <div class="controls">
                            <input type="file" name="multi_img[]" required="" class="form-control" multiple="" id="multiImage"></div>
                        </div>
                        @error('multi_img')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        {{-- Display Multi Image --}}
                        <div class="row" id="preview_img"></div>
                    </div>
                    </div> 

                    {{-- seventh --}}
                    <div class="row my-2"> 
                    {{-- start first col --}}
                    <div class="col-md-6">
                 <div class="form-group">
                            <h5>Short Description English</h5>
                            <div class="controls">
                                <textarea name="short_desc_en" id="textarea" class="form-control" required="" placeholder="Textarea text"></textarea>
                            </div>
                
                            @error('short_desc_en')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                        {{-- start second col --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <h5>Short Description Arabic</h5>
                            <div class="controls">
                                <textarea name="short_desc_ar" id="textarea" class="form-control" required="" placeholder="Textarea text"></textarea>
                            </div>
                
                            @error('short_desc_ar')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                        {{-- start Third col --}}
                    
                    </div> 
               </div>

              
           <div class="row">
            <div class="col-6">           
                   <div class="form-group">
                       <h5>Long Description English <span class="text-danger">*</span></h5>
                       <div class="controls">
                        <textarea id="editor1" required="" name="long_desc_en" rows="10" cols="80">
                            Long Description English
                        </textarea>

                        @error('long_desc_en')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                   </div>
               </div>
             <div class="col-md-6">
                <div class="form-group">
                    <h5>Long Description Arabic <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <textarea id="editor2" required="" name="long_desc_ar" rows="10" cols="80">
                            Long Description English 
                        </textarea>

                     @error('long_desc_ar')
                     <span class="text-danger">{{$message}}</span>
                     @enderror
                 </div>
                </div>
             </div>
         </div>
             </div>
         
                 
                 </div>
                 <hr>
                   <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">

                            <div class="controls">
                                <fieldset>
                                    <input type="checkbox" id="checkbox_1" name="hot_deals" value="1">
                                    <label for="checkbox_1">Hot Deals</label>
                                </fieldset>
                                <fieldset>
                                    <input type="checkbox" id="checkbox_2" name="featured" value="1">
                                    <label for="checkbox_2">Featured</label>
                                </fieldset>
                         </div>
                        </div>
                    </div>
                       <div class="col-md-6">
                           <div class="form-group">

                               <div class="controls">
                                   <fieldset>
                                       <input type="checkbox" id="checkbox_3" name="spicial_offer"  value="1">
                                       <label for="checkbox_3">Spicial Offer</label>
                                   </fieldset>
                                   <fieldset>
                                       <input type="checkbox" id="checkbox_4" name="spicial_deal" value="1">
                                       <label for="checkbox_4">Spicial Deal</label>
                                   </fieldset>
                            </div>
                           </div>
                       </div>
                   </div>
              
                   <div class="text-xs-right">
                       <input type="submit" value="Add Product" class="btn btn-primary btn-rounded mb-5">
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
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id){
                $.ajax({
                    url:"{{ url('/category/subcategory/ajax')}}/"+category_id,
                    type:'GET',
                    dataType:"json",
                    success: function(data){
                        $("select[name='subsubcategory_id']").html('');
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


    $(document).ready(function(){
        $('select[name="subcategory_id"]').on('change', function(){
            var subcategory_id = $(this).val();
            if(subcategory_id){
                $.ajax({
                    url:"{{ url('/category/subsubcategory/ajax')}}/"+subcategory_id,
                    type:'GET',
                    dataType:"json",
                    success: function(data){   
                        console.log(data);  
                        var d = $("select[name='subsubcategory_id']").empty();
                        $.each(data, function(key, value){
                            console.log(value.subsubcategory_name_en)
                            $('select[name="subsubcategory_id"').append(`
                            <option value="${value.id}">${value.subsubcategory_name_en}</option>
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

    {{-- Another Script --}}
    <script type="text/javascript">
        function mainThumUrl(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#mainThum').attr('src',e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>

    {{-- show multi Image --}}
    <script>
 
        $(document).ready(function(){
         $('#multiImage').on('change', function(){ //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data
                 
                $.each(data, function(index, file){ //loop though each file
                    if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file){ //trigger function on successful read
                        return function(e) {
                            var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                        .height(80); //create image element 
                            $('#preview_img').append(img); //append image to output element
                        };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });
                 
            }else{
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
         });
        });
         
        </script>
@endsection
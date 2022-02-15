<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
{{--  to use Ajax post method! --}}
<meta name="csrf-token" content="{{csrf_token()}}">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>@yield('title')</title>

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">

<!-- Customizable CSS -->

<link rel="stylesheet" href="{{asset('frontend/assets/css/main.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/blue.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/owl.carousel.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/owl.transitions.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/animate.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/rateit.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap-select.min.css')}}">
{{-- sweet Alert Is Here Coool --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Icons/Glyphs -->
<link rel="stylesheet" href="{{asset('frontend/assets/css/font-awesome.css')}}">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
{{-- toster --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://js.stripe.com/v3/"></script>
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
@include('frontend.body.header')

<!-- ============================================== HEADER : END ============================================== -->
@yield('content')
<!-- /#top-banner-and-menu --> 

<!-- ============================================================= FOOTER ============================================================= -->
@include('frontend.body.footer')
<!-- ============================================================= FOOTER : END============================================================= --> 

<!-- For demo purposes – can be removed on production --> 

<!-- For demo purposes – can be removed on production : End --> 

<!-- JavaScripts placed at the end of the document so the pages load faster --> 

<script src="{{asset('frontend/assets/js/jquery-1.11.1.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap-hover-dropdown.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/owl.carousel.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/echo.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/jquery.easing-1.3.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap-slider.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/jquery.rateit.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/assets/js/lightbox.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap-select.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/wow.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/scripts.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" type="text/javascript" referrerpolicy="no-referrer"></script>

  <script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
      case 'info':
        toastr.info("{{Session::get('message')}}");
        break;
      case 'success':
        toastr.success("{{Session::get('message')}}");
        break;
      case 'error':
        toastr.error("{{Session::get('message')}}");
        break;
      case 'warning':
        toastr.warning("{{Session::get('message')}}");
        break;
    }
    @endif
  </script>

  <!-- Add to Cart Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong id="pname"></strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModel">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="row">
          <div class="col-md-4">
            <div class="card" style="width: 18rem;">
              <img src="" class="card-img-top" alt="product_image" id='pimage' style="height: 200px; width:200px;" />
             
            </div>
          </div>
          {{--  end col-md --}}
          <div class="col-md-4">
            <ul class="list-group">
              <li class="list-group-item">Product Price: <strong class="text-danger">
                $<span id="pprice"></span>   
              </strong>
              <del id='oldPrice'></del>
            
            </li>
              <li class="list-group-item">Product Code: <strong id="pcode"></strong></li>
              <li class="list-group-item">Category: <strong id="pcategory"></strong></li>
              <li class="list-group-item">Brand: <strong id="pbrand"></strong></li>
              <li class="list-group-item">Stock: <strong id="availble" class="badge badge-pill"></strong> </li>
            </ul>
          </div>
            {{--  end col-md --}}
          <div class="col-md-4">
            <div class="form-group" >
              <label for="color">Choose Color:</label>
              <select class="form-control" id="color" name="color">
            
            
              </select>
            </div>
            {{-- end color --}}
            {{-- end form group --}}
            <div class="form-group" id="sizeArea">
              <label for="size">Choose Size:</label>
              <select class="form-control" id="size" name='size'>
               
             
              </select>
            </div>
            {{-- end form group --}}
            <div class="form-group">
              <label for="qty">Qty:</label>
              <input type="number" value='1' id="qty" min='1' class="form-control" >
             
            </div>
            <input type="hidden" id="product_id">
            <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">Add To Cart</button>
          </div>
            {{--  end col-md --}}
       </div>
       {{-- end row --}}





      </div>
   
    </div>
  </div>
</div>
{{-- End Add to cart Mohna can you please fill  --}}

<script type="text/javascript">
  $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })
  // start product view with model
  function prodcutView(id){
    // alert(id); 
    $.ajax({
      type: 'GET',
      url: `/product/view/model/${id}`,
      dataType: 'json',
      success:function(data){
        // clear data
  
        // console.log(data);
        // to pass prodcut Id with cart
        $("#product_id").val(id);
        $("#pname").text(data.product.product_name_en);
        $("#price").text("$"+data.product.selling_price);
        $("#pcode").text("#"+data.product.product_code);
        $("#pcategory").text(data.product.category.category_name_en);
        $("#pbrand").text(data.product.brand.brand_name_en);
        $("#pimage").attr('src','/'+data.product.product_thmbnail);
        $("#qty").val(1);
        // product price check if there is a discount price or not.
        if(data.product.discount_price === null){
          $("#oldPrice").text("");
          $("#pprice").text("");
          $("#pprice").text(data.product.selling_price);
        }else{
          $("#pprice").text(data.product.discount_price);
          $("#oldPrice").text("$"+data.product.selling_price);
        } // End Product Price
        // Start Stock Option.

        // instuck or not
        if(data.product.product_qty > 0){
          $("#availble").text('In Stock').css('color', 'white').addClass('badge-success');
        }else{
          $("#availble").text('Out of Stock').css('color', 'white').addClass('badge-danger');
        }


        
        $('select[name="color"]').empty();
        // color stuff
        $.each(data.color, function(key,value){
          $('select[name="color"]').append(`
            <option value="${value}">
              ${value}
            </option>`
            );
        });
        // End Color
        // Size stuff
        $('select[name="size"]').empty();
        $.each(data.size, function(key,value){
          $('select[name="size"]').append(`
            <option value="${value}">
              ${value}
            </option>`
            );
            if(data.size==""){
              $("#sizeArea").hide();
            }else{
              $("#sizeArea").show();
            }
        });
        // end size 
      }
    })
  }
  // End Product View with Modal

  //  Start Add to Cart Product
  function addToCart(){
    var productName = $("#pname").text();
    var productId = $("#product_id").val();
    var color = $("#color option:selected").text();
    var size = $("#size option:selected").text();
    var quantity = $("#qty").val();
    $.ajax({
      type: "POST",
      dataType: "json",
      data:{
        color,
        productName,
        size,
        quantity
      },
      url:`/cart/data/store/${productId}`,
      success:function(data){
        $("#closeModel").click();
        miniCart();
        // console.log(data);
        // start Message Alert
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        icon: 'success',
        showConfirmButton: false,
        timer: 3000
        }); 
        if ($.isEmptyObject(data.error)) {
          Toast.fire({
            type: 'success',
            title: data.success,
          })
        }else{
          Toast.fire({
            type: 'error',
            title: data.error,
          })
        }


        // End Message Alert Cooooooooool.
      }
    })
  }

  // End Add To Cart Product
</script>

{{-- get cart scripts --}}
<script type="text/javascript">
function miniCart(){
  $.ajax({
    type: "GET",
    url:"/product/min/cart",
    dataType: "json",
    success: function(response){
      var miniCart = "";
      $("span[id='cartSubtotal']").text("$"+response.cartTotal);
      $("#cartQty").text(response.cartQty);
      $.each(response.carts, function(key, value) {
       miniCart += `<div class="cart-item product-summary">
    <div class="row">
      <div class="col-xs-4">
        <div class="image"> <a href="detail.html"><img src="${value.options.image}" alt=""></a> </div>
      </div>
      <div class="col-xs-7">
        <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
        <div class="price">$${value.price} X ${value.qty}</div>
      </div>
      <div class="col-xs-1 action"> 
        <button type="submit" id=${value.rowId} onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button>
       </div>
    </div>
  </div>`;
      });
      $("#miniCart").html(miniCart);
    
    }
  })
}
miniCart();


// script MiniCart remove item
// mini cart reomve 
function miniCartRemove(id){
  $.ajax({
    type:'GET',
    url:`/minicart/product-remove/${id}`,
    dataType:"json",
    success:(data) => {
      miniCart();
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        icon: 'success',
        showConfirmButton: false,
        timer: 3000
        }); 
        if($.isEmptyObject(data.error)) {
          Toast.fire({
            type: 'success',
            title: data.success,
          })
        }else{
          Toast.fire({
            type: 'error',
            title: data.error,
          })
        }
    }
    
  })
}
// endmini cart reomve
</script>

{{-- Add Wish List Functions --}}
<script type="text/javascript">
function addToWishlist(product_id){
  $.ajax({
    type:"POST",
    dataType:"json",
    url:`/add-to-wishlist/${product_id}`,
    success: function(data){
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        }); 
        if($.isEmptyObject(data.error)) {
          Toast.fire({
            type: 'success',
            icon: 'success',
            title: data.success,
          })
        }else{
          Toast.fire({
            type: 'error',
            icon: 'error',
            title: data.error,
          })
        }
    }
  })
}




</script>
{{-- End Wishlist Functions  --}}

<script type="text/javascript">
  function wishlist(){
  $.ajax({
    type: "GET",
    url:"/user/get-wishlist-product",
    dataType: "json",
    success: function(response){
      var rows = "";
      $.each(response, function(key, value) {
       rows += `<tr>
					<td class="col-md-2"><img src="/${value.product.product_thmbnail}" alt="imga"></td>
					<td class="col-md-7">
						<div class="product-name"><a href="#">${value.product.product_name_en}</a></div>
						<div class="rating">
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star non-rate"></i>
							<span class="review">( 06 Reviews )</span>
						</div>
						<div class="price">
              ${value.product.discount_price === null 
                ? `$${value.product.selling_price}`
                : `$${value.product.discount_price} <span>$${value.product.selling_price}</span>`
                }			
						</div>
					</td>
					<td class="col-md-2">
            <button class="btn btn-primary icon" data-toggle="modal" data-target="#exampleModal" id=${value.product_id} onclick="prodcutView(this.id)" type="button"> <i class="fa fa-shopping-cart"></i> Add to Cart </button>
					</td>
					<td class="col-md-1 close-btn">
						<button type="submit" id="${value.product_id}" onclick="wishlistRemove(this.id)" class=""><i class="fa fa-times"></i></button>
					</td>
				</tr>
`;
      });
      $("#wishlist").html(rows);
    
    }
  })
}
wishlist()
// start wishlist function.
function wishlistRemove(id){
  $.ajax({
    type:'GET',
    url:`/user/wishlist-remove/${id}`,
    dataType:"json",
    success:(data) => {
      wishlist();
      
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        }); 
        if($.isEmptyObject(data.error)) {
          Toast.fire({
            type: 'success',
            icon: 'success',
            title: data.success,
          })
        }else{
          Toast.fire({
            type: 'error',
            icon: 'error',
            title: data.error,
          })
        }
    }
    
  })
}
// endwishlist function.
</script>

{{-- // cart Page scripts --}}

<script type="text/javascript">
  function cart(){
  $.ajax({
    type: "GET",
    url:"/get-cart-product",
    dataType: "json",
    success: function(response){
      console.log(response);
      var rows = "";
      $.each(response.carts, function(key, value) {
       rows += `<tr>
					<td class="col-md-2"><img src="/${value.options.image}" alt="imga" style="width:60px; height: 60px;"></td>
					<td class="col-md-2">
						<div class="product-name"><a href="#">${value.name}</a></div>
						<div class="price">
              $${value.price}	
						</div>
					</td>

          <td class="col-md-2">
						<strong>${value.options.color}</strong>
					</td>

          <td class="col-md-2">
            ${value.options.size === null
            ? `<span>...</span>`
            :`<strong>${value.options.size}</strong>`
            }
					</td>

          <td class="col-md-2">
            <button type="submit" ${value.qty === 1 ? "disabled" : ""} id="${value.rowId}" onclick="cartDecrement(this.id)" class="btn btn-danger btn-sm">-</button>
            <input type="text" style="width:25px" value=${value.qty} min="1" max="100" disabled="disabled" />
            <button type="submit" id="${value.rowId}" onclick="cartIncrement(this.id)" class="btn btn-success btn-sm">+</button>
           
					</td>

          <td class="col-md-2">
						<strong>$${value.subtotal}</strong>
					</td>

					<td class="col-md-1 close-btn">
						<button type="submit" id="${value.rowId}" onclick="RemoveCartItem(this.id)" class="btn btn-danger"><i class="fa fa-times"></i></button>
					</td>
				</tr>
`;
      });
      $("#cartPage").html(rows);
    
    }
  })
}
// run the function
cart();
// start wishlist function.
function RemoveCartItem(id){

  $.ajax({
    type:'GET',
    url:`/cart-remove/${id}`,
    dataType:"json",
    success:(data) => {
      cart();
      miniCart();
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        }); 
        if($.isEmptyObject(data.error)) {
          Toast.fire({
            type: 'success',
            icon: 'success',
            title: data.success,
          });
          couponCaculation();
          $('#coupon-box').show(1000);
          $('#coupon_name').val('');
        }else{
          Toast.fire({
            type: 'error',
            icon: 'error',
            title: data.error,
          })
        }
    }
    
  })
}
// endwishlist function.



// Cart Incerement quantity
function cartIncrement(rowId){
  $.ajax({
    type: "GET",
    url:`/cart-increment/${rowId}`,
    dataType: "json",
    success: function(response){
      cart();
      miniCart();
      couponCaculation();
    }
    
  })
}
// end cart incremenet

function cartDecrement(rowId){
  $.ajax({
    type: "GET",
    url:`/cart-decrement/${rowId}`,
    dataType: "json",
    success: function(response){
      cart();
      miniCart();
      couponCaculation();
    }
    
  })
}
</script>

{{-- copuon apply Start Woooooo! --}}
<script type="text/javascript">
function applyCoupon(){
  var couponName = $('#coupon_name').val();
  $.ajax({
    type:"POST",
    dataType: "json",
    data:{coupon_name: couponName},
    url: "{{url('/coupon-apply')}}",
    success:function(data){
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        }); 
        if($.isEmptyObject(data.error)) {
          Toast.fire({
            type: 'success',
            icon: 'success',
            title: data.success,
          })
          couponCaculation(); 
          $('#coupon-box').hide(1000);
        }else{
          Toast.fire({
            type: 'error',
            icon: 'error',
            title: data.error,
          })
        }


    }
  })
}



function couponCaculation(){
  $.ajax({
    type: 'GET',
    url: "{{url('/coupon-calculation')}}",
    dataType: 'json',
    success:function(data){
      if (data.total) {
        $('#couponCalField').html(`
        <tr>
				<th>
					<div class="cart-sub-total">
						Subtotal<span class="inner-left-md">$${data.total}</span>
					</div>
					<div class="cart-grand-total">
						Grand Total<span class="inner-left-md">$${data.total}</span>
					</div>
				</th>
			</tr>
        
        `);
      }else{
        $('#couponCalField').html(`
        <tr>
				<th>
					<div class="cart-sub-total">
						Subtotal<span class="inner-left-md">$${data.subtotal}</span>
					</div>

          <div class="cart-sub-total">
						Coupon<span class="inner-left-md">${data.coupon_name}</span>
            <button type='submit' class='btn btn-danger btn-sm' onclick='couponRemove()'><i class='fa fa-times'></i></button>
					</div>

          <div class="cart-sub-total">
						Discount Amount<span class="inner-left-md">$${data.discount_amount}</span>
					</div>


					<div class="cart-grand-total">
						Grand Total<span class="inner-left-md">$${data.total_amount}</span>
					</div>
				</th>
			</tr>
        
        `);
      }
    }
  });
}

couponCaculation();


function couponRemove(){
  $.ajax({
    type: 'GET',
    dataType: 'json',
    url: '{{url("/coupon-remove")}}',
    success: function(data){
      couponCaculation();
      $('#coupon-box').show(1000);
      $('#coupon_name').val('');
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        }); 
        if($.isEmptyObject(data.error)) {
          Toast.fire({
            type: 'success',
            icon: 'success',
            title: data.success,
          });
       
        }else{
          Toast.fire({
            type: 'error',
            icon: 'error',
            title: data.error,
          })
        }
      
    }
  })
}
</script>





{{-- End Coupon Apply --}}






{{-- // end cart page script --}}
</body>
</html>
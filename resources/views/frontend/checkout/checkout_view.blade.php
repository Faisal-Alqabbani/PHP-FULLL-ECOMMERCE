@extends('frontend.main_master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('content')
@section('title')
My cart Page
@endsection

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

{{-- checkout page  --}}

<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
<div class="panel panel-default checkout-step-01">

	<!-- panel-heading -->
	
    <!-- panel-heading -->

	<div id="collapseOne" class="panel-collapse collapse in">

		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">		

				<!-- guest-login -->			
				<div class="col-md-6 col-sm-6 already-registered-login">
					<h4 class="checkout-subtitle"> <b>Shipping Address </b></h4>
				
					<form class="register-form" action={{route('checkout.store')}} method="POST">
						@csrf
					<div class="form-group">
					    <label class="info-title" for="exampleInputEmail1">Shipping Name<span>*</span></label>
					    <input type="text" value="{{Auth::user()->name}}" name="shipping_name" required="" class="form-control unicase-form-control text-input" placeholder='Full Name' id="exampleInputEmail1">
					</div>
					{{-- end form group --}}

					<div class="form-group">
					    <label class="info-title" for="exampleInputEmail1">Shipping Email<span>*</span></label>
					    <input type="email" required="" value="{{Auth::user()->email}}" name="shipping_email" class="form-control unicase-form-control text-input" placeholder='Email Address' id="exampleInputEmail1">
					</div>
					{{-- end form group --}}


					<div class="form-group">
					    <label class="info-title" for="exampleInputEmail1">Shipping Phone<span>*</span></label>
					    <input type="number" required="" value="{{Auth::user()->phone}}" name="shipping_phone" class="form-control unicase-form-control text-input" placeholder='Your Phone' id="exampleInputEmail1">
					</div>
					{{-- end form group --}}

					<div class="form-group">
					    <label class="info-title" for="exampleInputEmail1">Post Code<span>*</span></label>
					    <input type="text" required=""  name="post_code" class="form-control unicase-form-control text-input" placeholder='Post Code' id="exampleInputEmail1">
					</div>
	
	
					{{-- end form  --}}
				</div>	
				<!-- guest-login -->

				<!-- already-registered-login -->
				<div class="col-md-6 col-sm-6 already-registered-login">
				
					<div class="form-group">
						<h5>Division Name <span class="text-danger">*</span></h5>
						<select name="division_id" class="form-control">
							<option value="" selected="" disabled="">Select Your Division</option>
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
						<select class="form-control" name="district_id" disabled="">
							
						</select>
						@error('district_id')
						<span class="text-danger">{{$message}}</span>
						@enderror
					</div>

					<div class="form-group">
						<h5>State Name <span class="text-danger">*</span></h5>
						<select class="form-control" name="state_id" disabled="">
							
						</select>
						@error('state_id')
						<span class="text-danger">{{$message}}</span>
						@enderror
					</div>

					<div class="form-group">
						<h5>Notes <span class="text-danger">*</span></h5>
					    <textarea class="form-control" placeholder="Notes" name="notes" cols="30" rows="5"></textarea>
					
					</div>
	
	
					{{-- end form  --}}



					  
				
				</div>	
				<!-- already-registered-login -->		

			</div>			
		</div>
		<!-- panel-body  -->

	</div><!-- row -->
</div>
<!-- checkout-step-01  -->
					   	<!-- checkout-step-06  -->
					  	
					</div><!-- /.checkout-steps -->
				</div>
				<div class="col-md-4">
					<!-- checkout-progress-sidebar -->
<div class="checkout-progress-sidebar ">
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
		    	<h4 class="unicase-checkout-title">Your Checkout Progress</h4>
		    </div>
		    <div class="">
				<ul class="nav nav-checkout-progress list-unstyled">
                    @foreach($carts as $item)
					<li>
                        <strong>Image: </strong>
                        <img src="{{asset($item->options->image)}}" alt="" style='width:50px; height: 50px;'>
                    </li>
                    
                    <li>
                        <strong>Quantity: </strong>
                        {{$item->qty}}
                        <strong>Color: </strong>
                        {{$item->options->color}}
                        <strong>Size: </strong>
                        {{$item->options->size}}
                        <hr>
                    </li>
                    @endforeach
                    
                    <li>
                        @if(Session::has('coupon'))
                        <strong>SubTotal: </strong>
                        ${{$cartTotal}}
                        <hr>
                        <strong>Coupon Name: </strong>
                        {{session()->get('coupon')['coupon_name']}}
                        ( %{{session()->get('coupon')['coupon_discount']}} )
                        <hr>
                        <strong>Coupon Discount: </strong>
                        ${{session()->get('coupon')['discount_amount']}}
                        <hr>
                        <strong>Grand Total: </strong>
                        ${{session()->get('coupon')['total_amount']}}
                        @else
                        <strong>SubTotal: </strong>
                        ${{$cartTotal}}
                        <hr>
                        <strong>Grand Total: </strong>
                        ${{$cartTotal}}
                        <hr>

                        @endif
                        
                        
                    </li>
				</ul>		
			</div>
		</div>
	</div>
</div> 

<div class="checkout-progress-sidebar ">
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
		    	<h4 class="unicase-checkout-title">Select Payment Method</h4>
		    </div>
		    <div class="row">
				<div class="col-md-4">
					<label for="">Stripe</label>
					<input type="radio" name="payment_method" value="stripe" />
					<img src="{{asset('frontend/assets/images/payments/4.png')}}" alt="">
				</div>
				{{-- end col md 4 --}}
				<div class="col-md-4">
					<label for="">Card</label>
					<input type="radio" name="payment_method" value="card" />
					<img src="{{asset('frontend/assets/images/payments/3.png')}}" alt="">
				</div>
				{{-- end col md 4 --}}
				<div class="col-md-4">
					<label for="">Cash</label>
					<input type="radio" name="payment_method" value="cash" />
					<img src="{{asset('frontend/assets/images/payments/2.png')}}" alt="">
				</div>
				
				{{-- end col md 4 --}}
			</div>
				<hr>
				<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Payment Step</button>
			</div>
			{{-- end row --}}
		</div>
	</div>
</div> 

<!-- checkout-progress-sidebar -->
        </div>
	</form>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->

<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->






<script>
    $(document).ready(function(){
    $('select[name="division_id"]').on('change', function(){
        var division_id = $(this).val();
		var state_select = $('select[name="state_id"]');
		var d = $("select[name='district_id']");
		state_select.empty();
		state_select.attr('disabled', true);
        if(division_id){
            $.ajax({
                url:"{{ url('/distict/ajax')}}/"+division_id ,
                type:'GET',
                dataType:"json",
                success: function(data){
                    d.empty();
					d.attr("disabled",false);
					d.append(`
					<option value="" selected="">-- Select District --</option>
					`);	
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


$(document).ready(function(){
	$('select[name="district_id"]').on('change', function(){
		var district_id = $(this).val();
		if(district_id){
			$.ajax({
				type: "GET",
				dataType: 'json',
				url: "{{url('/state/ajax')}}/"+district_id,
				success:function(data){
					var state_id = $('select[name="state_id"]');
					state_id.empty();
					state_id.attr("disabled",false);
					state_id.append(`
					<option value="" selected="">-- Select State --</option>
					`);	
					$.each(data, function(key,value){
					state_id.append(`
					<option value=${value.id}>${value.state_name} </option>
					`);	
					})
				
				}
			})
		}else{
			alert('Error');
		}
	});
})
</script>









@endsection
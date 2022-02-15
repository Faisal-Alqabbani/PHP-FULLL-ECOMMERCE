@php 

$brands = \App\Models\Brand::orderBy('created_at')->get();

@endphp
<div id="brands-carousel" class="logo-slider wow fadeInUp">
          
    <div class="logo-slider-inner">


      <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
        @foreach($brands as $brand)
        <div class="item m-t-15"> <a href="#" class="image"> <img style="width: 100px; height: 100px;" data-echo="{{asset($brand->brand_image)}}" src="{{asset('frontend/assets/images/blank.gif')}}" alt=""> </a> </div>
        @endforeach
          
      
        <!--/.item-->
{{--         
        <div class="item m-t-10"> <a href="#" class="image"> <img data-echo="{{asset('frontend/assets/images/brands/brand2.png')}}" src="{{asset('frontend/assets/images/blank.gif')}}" alt=""> </a> </div>
        <!--/.item-->
        
        <div class="item"> <a href="#" class="image"> <img data-echo="{{asset('frontend/assets/images/brands/brand3.png')}}" src="{{asset('frontend/assets/images/blank.gif')}}" alt=""> </a> </div>
        <!--/.item-->
        
        <div class="item"> <a href="#" class="image"> <img data-echo="{{asset('frontend/assets/images/brands/brand4.png')}}" src="{{asset('frontend/assets/images/blank.gif')}}" alt=""> </a> </div>
        <!--/.item-->
        
        <div class="item"> <a href="#" class="image"> <img data-echo="{{asset('frontend/assets/images/brands/brand5.png')}}" src="{{asset('frontend/assets/images/blank.gif')}}" alt=""> </a> </div>
        <!--/.item-->
        
        <div class="item"> <a href="#" class="image"> <img data-echo="{{asset('frontend/assets/images/brands/brand6.png')}}" src="{{asset('frontend/assets/images/blank.gif')}}" alt=""> </a> </div>
        <!--/.item-->
        
        <div class="item"> <a href="#" class="image"> <img data-echo="{{asset('frontend/assets/images/brands/brand2.png')}}" src="{{asset('frontend/assets/images/blank.gif')}}" alt=""> </a> </div>
        <!--/.item-->
        
        <div class="item"> <a href="#" class="image"> <img data-echo="{{asset('frontend/assets/images/brands/brand4.png')}}" src="{{asset('frontend/assets/images/blank.gif')}}" alt=""> </a> </div>
        <!--/.item-->
        
        <div class="item"> <a href="#" class="image"> <img data-echo="{{asset('frontend/assets/images/brands/brand1.png')}}" src="{{asset('frontend/assets/images/blank.gif')}}" alt=""> </a> </div>
        <!--/.item-->
        
        <div class="item"> <a href="#" class="image"> <img data-echo="{{asset('frontend/assets/images/brands/brand5.png')}}" src="{{asset('frontend/assets/images/blank.gif')}}" alt=""> </a> </div> --}}
        <!--/.item--> 
      </div>
      <!-- /.owl-carousel #logo-slider --> 
    </div>
    <!-- /.logo-slider-inner --> 
    
  </div>
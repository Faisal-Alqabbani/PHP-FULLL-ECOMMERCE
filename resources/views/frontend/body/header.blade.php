<header class="header-style-1"> 
  
    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
      <div class="container">
        <div class="header-top-inner">
          <div class="cnt-account">
            <ul class="list-unstyled">
              <li><a href="#"><i class="icon fa fa-user"></i>
                @if(session()->get('language') == 'arabic')
                حسابي 
              @else 
                Language 
              @endif
              </a></li>
              <li><a href="{{route('wishlist')}}"><i class="icon fa fa-heart"></i>
                @if(session()->get('language') == 'arabic') 
                المفضلة
                @else 
                Wishlist
                @endif
              </a></li>
              <li>
                <a href="{{route('mycart')}}"><i class="icon fa fa-shopping-cart"></i>
                @if(session()->get('language') == 'arabic')
              سلة المشتريات
              @else 
              My Cart
              @endif
               
              
              </a></li>
              <li><a href="{{route('checkout')}}"><i class="icon fa fa-check"></i>
                @if(session()->get('language') == 'arabic')
              الدفع
                @else 
                Checkout
                @endif
              
              </a></li>
              @auth
              <li>
                <a href="{{route('dashboard')}}"><i class="icon fa fa-user"></i>
                @if(session()->get('language') == 'arabic')
                الملف الشخصي 
              @else 
              User Profile
              @endif
               </a></li>
              @else
              <li><a href="{{route('login')}}"><i class="icon fa fa-lock"></i>
                @if(session()->get('language') == 'arabic')
                تسجيل الدخول
              @else 
              Login/Register
              @endif
  
              </a></li>
              @endauth
        
            </ul>
          </div>
          <!-- /.cnt-account -->
          
          <div class="cnt-block">
            <ul class="list-unstyled list-inline">
              <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">USD</a></li>
                  <li><a href="#">INR</a></li>
                  <li><a href="#">GBP</a></li>
                </ul>
              </li>
              <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">
              @if(session()->get('language') == 'arabic')
                اللغة 
              @else 
                Language 
              @endif
              </span><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  @if(session()->get('language') == 'arabic')
                  <li><a href="{{route('english.language')}}">English</a></li>
                  @else
                  <li><a href="{{route('arabic.language')}}">عربي</a></li>
                  @endif
                </ul>
              </li>
            </ul>
            <!-- /.list-unstyled --> 
          </div>
          <!-- /.cnt-cart -->
          <div class="clearfix"></div>
        </div>
        <!-- /.header-top-inner --> 
      </div>
      <!-- /.container --> 
    </div>
    <!-- /.header-top --> 
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-3 logo-holder"> 
            <!-- ============================================================= LOGO ============================================================= -->
            <div > <a href="{{url('/')}}"> <h1 class="logof">Faisal's Store </h1> </a> </div>
            <!-- /.logo --> 
            <!-- ============================================================= LOGO : END ============================================================= --> </div>
          <!-- /.logo-holder -->
          
          <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder"> 
            <!-- /.contact-row --> 
            <!-- ============================================================= SEARCH AREA ============================================================= -->
            <div class="search-area">
              <form>
                <div class="control-group">
                  <ul class="categories-filter animate-dropdown">
                    <li class="dropdown"> <a class="dropdown-toggle"  data-toggle="dropdown" href="category.html">Categories <b class="caret"></b></a>
                      <ul class="dropdown-menu" role="menu" >
                        <li class="menu-header">Computer</li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Clothing</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Electronics</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Shoes</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Watches</a></li>
                      </ul>
                    </li>
                  </ul>
                  <input class="search-field" placeholder="Search here..." />
                  <a class="search-button" href="#" ></a> </div>
              </form>
            </div>
            <!-- /.search-area --> 
            <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
          <!-- /.top-search-holder -->
          
          <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row"> 


            <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
            
            <div class="dropdown dropdown-cart">
             <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
              <div class="items-cart-inner">
                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                <div class="basket-item-count"><span class="count" id="cartQty">0</span></div>
                <div class="total-price-basket"> <span class="lbl">cart -</span> <span class="total-price"> <span class="sign"></span><span class="value" id="cartSubtotal">0</span> </span> </div>
              </div>
              </a>
              <ul class="dropdown-menu">
                <li>
                 {{-- Mini Cart Start With Ajax   --}}
                  <div id="miniCart">
                    
                  </div>

                 {{-- End Mini Cart with Ajax --}}
                  <!-- /.cart-item -->
                  <div class="clearfix"></div>
                  <hr>
                  <div class="clearfix cart-total">
                    <div class="pull-right"> <span class="text" >Sub Total :</span><span class='price' id="cartSubtotal">$0</span> </div>
                    <div class="clearfix"></div>
                    <a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> </div>
                  <!-- /.cart-total--> 
                  
                </li>
              </ul>
              <!-- /.dropdown-menu--> 
            </div>
            <!-- /.dropdown-cart --> 
            
            <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> </div>
          <!-- /.top-cart-row --> 
        </div>
        <!-- /.row --> 
        
      </div>
      <!-- /.container --> 
      
    </div>
    <!-- /.main-header --> 
    
    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
      <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
          <div class="navbar-header">
         <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
         <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          </div>
          <div class="nav-bg-class">
            <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
              <div class="nav-outer">
                <ul class="nav navbar-nav">
                  <li class="active dropdown yamm-fw"> <a href="{{url('/')}}" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Home</a> </li>
                  {{-- put your php code here fetch  --}}
                  {{-- get category table data --}}
                  @php
                  $categories = App\Models\Category::orderBy('category_name_en', 'ASC')->get();
                  @endphp

                  @foreach($categories as $category)
                  <li class="dropdown yamm mega-menu"> 
                    <a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">
                      @if(session()->get('language') == 'arabic') {{$category->category_name_ar}} @else {{$category->category_name_en}} @endif
                  </a>
                    <ul class="dropdown-menu container">
                      <li>
                <div class="yamm-content ">
                  <div class="row">
                   
                      {{-- Get SubCategory --}}
                      @php
                      $subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name_en', 'ASC')->get();
                      @endphp
                      @foreach($subcategories as $subcategory)
                     <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                       <a href="{{url('/category/product/'.$subcategory->id.'/'.$subcategory->subcategory_slug_en)}}">
                      <h2 class="title"> @if(session()->get('language') == 'arabic') {{$subcategory->subcategory_name_ar}} @else {{$subcategory->subcategory_name_en}} @endif</h2>
                      </a>
                      <ul class="links">
                        @php
                        $subsubcategories = App\Models\SubSubCategory::where('subcategory_id',$subcategory->id)->orderBy('subsubcategory_name_en', 'ASC')->get();
                        @endphp

                        {{-- start subsubcategory --}}
                        @foreach($subsubcategories as $subsubcategory)
                        <li><a href="{{url('/subsubcategory/product/'.$subsubcategory->id.'/'.$subsubcategory->subsubcategory_slug_en)}}">    @if(session()->get('language') == 'arabic') {{$subsubcategory->subsubcategory_name_ar}} @else {{$subsubcategory->subsubcategory_name_en}} @endif</a></li>
                        @endforeach
                        {{-- End subsubcateogry --}}
                      </ul>
                    </div>
                    @endforeach
                     {{-- // End foreach subcategory --}}
                    <!-- /.col -->
                  
                    <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image"> <img class="img-responsive" src="assets/images/banners/top-menu-banner.jpg" alt=""> </div>
                    <!-- /.yamm-content --> 
                  </div>
                </div>
                      </li>
                    </ul>
                  </li>
                  @endforeach  
                  {{-- // End foreach category --}}
                </ul>
                <!-- /.navbar-nav -->
                <div class="clearfix"></div>
              </div>
              <!-- /.nav-outer --> 
            </div>
            <!-- /.navbar-collapse --> 
            
          </div>
          <!-- /.nav-bg-class --> 
        </div>
        <!-- /.navbar-default --> 
      </div>
      <!-- /.container-class --> 
      
    </div>
    <!-- /.header-nav --> 
    <!-- ============================================== NAVBAR : END ============================================== --> 
    
  </header>
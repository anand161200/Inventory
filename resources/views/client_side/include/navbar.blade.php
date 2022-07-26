 <!-- Mobile Nav (max width 767px)-->
 <div class="mobile-nav">
    <!-- Navbar Brand -->
    <div class="amado-navbar-brand">
        <a href="index.html"><img src="{{ asset('user/img/core-img/logo.png') }}" alt=""></a>
                            
    </div>
    <!-- Navbar Toggler -->
    <div class="amado-navbar-toggler">
        <span></span><span></span><span></span>
    </div>
</div>

<!-- Header Area Start -->
<header class="header-area clearfix">
    <!-- Close Icon -->
    <div class="nav-close">
        <i class="fa fa-close" aria-hidden="true"></i>
    </div>
    <!-- Logo -->
    <div class="logo">
        <a href="index.html"><img src="{{ asset('user/img/logo.png') }}" alt=""></a>
    </div>
    @auth
    <div>
        <h4> <i class="fa fa-user" aria-hidden="true"> &nbsp; </i>{{ Auth::user()->firstName }}</h4>
    </div>
    @endauth

    <!-- Amado Nav -->
    <nav class="amado-nav">
        <ul>
            <li class="active"><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('shop') }}">Shop</a></li>
            {{-- <li><a href="{{ route('product') }}">Product</a></li> --}}
            @auth
            <li><a href="{{ route('CartList') }}">Cart</a></li>
            @endauth

            @auth
              <li><a href="{{ route('myorder') }}">My Order</a></li>   
            @endauth
        </ul>
    </nav>
    <!-- Button Group -->
    <div class="amado-btn-group mt-30 mb-100">
        <a href="#" class="btn amado-btn mb-15">%Discount%</a>
        <a href="#" class="btn amado-btn active">New this week</a>
    </div>
    <!-- Cart Menu -->
    <div class="cart-fav-search mb-100">

        @auth 
        <a href="cart.html" class="cart-nav"><img src="{{asset('user/img/core-img/cart.png')}}" alt=""> Cart <span>(0)</span></a> 
        @endauth

        @guest            
        <a href="{{route('login_form')}}" class="fav-nav"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
        <a href="{{route('register_form')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> Regiter</a>
        @endguest

        @auth
        <a href="{{route('logout')}}" class="fav-nav"><i class="fa fa-power-off "></i> Logout</a>
        @endauth
    </div>                                            
    <!-- Social Button -->
    <div class="social-info d-flex justify-content-between">
        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
    </div>
</header>
<!-- Header Area End -->

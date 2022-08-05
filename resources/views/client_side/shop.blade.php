@extends('client_side.include.user_layout')
@section('content')
    
<div class="shop_sidebar_area">

    <div class="widget catagory mb-50">
        <!-- Widget Title -->
        <h6 class="widget-title mb-30">Brands</h6>
            {{-- @dump($brand); --}}
        <!--  Catagories  -->
        <div class="catagories-menu">
            <ul>
                @foreach ($brand as $data )
                <li><a href="#">{{$data->name}}</a></li>   
                @endforeach
            </ul>
        </div>
    </div>

    <div class="widget price mb-50">
        <!-- Widget Title -->
        <h6 class="widget-title mb-30">Price</h6>

        <div class="widget-desc">
            <div class="slider-range">
                <div data-min="10" data-max="1000" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="10" data-value-max="1000" data-label-result="">
                    <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                </div>
                <div class="range-price">$10 - $1000</div>
            </div>
        </div>
    </div>
</div>
<div class="amado_product_area section-padding-100">
    <div class="container-fluid">

        <div class="row">
                    {{-- @dump($item_list) --}}
            @foreach ( $item_list as $data )
                <div class="col-12 col-sm-3 col-md-12 col-xl-3">
                    <div class="single-product-wrapper">
                        <!-- Product Image -->
                        <div class="product-img">
                            <img src="{{ asset('user/img/product-img/oneplus/9rt.jpeg') }}" alt="">
                        </div>
                        <!-- Product Description -->
                        <div class="product-description d-flex align-items-center justify-content-between">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price">{{$data->price}}</p>
                                <a href="/viewItemDetails/{{$data->id}}">
                                    <h6>{{$data->name}}</h6>
                                </a>
                            </div>
                            <!-- Ratings & Cart -->
                            <div class="ratings-cart text-right">
                                <div class="cart">
                                    <a href="/addtocart/{{$data->id}}" data-toggle="tooltip" data-placement="left" title="Add to Cart"><img src="{{ asset('user/img/core-img/cart.png') }}" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach 
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Pagination -->
                <nav aria-label="navigation">
                    <ul class="pagination justify-content-end mt-50">
                        <li class="page-item active"><a class="page-link" href="#">01.</a></li>
                        <li class="page-item"><a class="page-link" href="#">02.</a></li>
                        <li class="page-item"><a class="page-link" href="#">03.</a></li>
                        <li class="page-item"><a class="page-link" href="#">04.</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
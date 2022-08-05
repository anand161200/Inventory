@extends('client_side.include.user_layout')
@section('content')

<div class="single-product-area section-padding-100 clearfix">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="single_product_thumb">
                    <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <a class="gallery_img" href="img/product-img/pro-big-1.jpg">
                                    <img class="d-block w-100" src="{{ asset('user/img/product-img/oneplus/9rt.jpeg') }}" alt="First slide">
                                </a>                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="single_product_desc">
                    <!-- Product Meta Data -->
                    <div class="product-meta-data">
                        <a href="product-details.html">
                            <h6>{{$itemDetails->name}}</h6>
                        </a>
                        <p class="product-price">₹{{$itemDetails->price}}</p>
                    </div>

                    <div class="short_overview my-5">
                        <p>A mobile phone, cellular phone, cell phone, cellphone, handphone, hand phone or pocket phone, sometimes shortened to simply mobile, cell, or just phone, is a portable telephone that can make and receive calls over a radio frequency link while the user is moving within a telephone service area.</p>
                    </div>

                    <!-- Add to Cart Form -->
                    <form class="cart clearfix" method="post">
                        <button type="submit" name="addtocart" value="5" class="btn amado-btn">Add to cart</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
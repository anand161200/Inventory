@extends('client_side.include.user_layout')
@section('content')
    
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="cart-title mt-50">
                    <h2>Shopping Cart</h2>
                </div>
                <div class="cart-table clearfix">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="cart_data">
                            {{-- @foreach ($all_cart as $data)
                            <tr>
                                <td class="cart_product_img">
                                    <a href="#"><img src="{{ asset('user/img/product-img/oneplus/9rt.jpeg') }}" alt="Product"></a>
                                </td>
                                <td class="cart_product_desc">
                                    <h5>{{$data->name}}</h5>
                                </td>
                                <td class="price">
                                    <span>{{$data->price}}</span>
                                </td>
                                <td class="qty">
                                    <div class="qty-btn d-flex">
                                        <p>Qty</p>
                                        <div class="quantity">
                                            <span class="qty-minus" onclick="minusButton({{$data->id}})"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                            <input type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="quantity" value="{{ $data->quantity }}">
                                            <span class="qty-plus" onclick="plusButton({{$data->id}})"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="cart-summary">
                    <h5>Cart Total</h5>
                    <ul class="summary-table">
                        <li><span>subtotal:</span> <span>$140.00</span></li>
                        <li><span>delivery:</span> <span>Free</span></li>
                        <li><span>total:</span> <span>$140.00</span></li>
                    </ul>
                    <div class="cart-btn mt-100">
                        <a href="cart.html" class="btn amado-btn w-100">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        let cart_data=document.getElementById('cart_data');
        let alldata='';

       window.onload=function() {
             recall();  
        }
        function recall()
        {
            axios.get('/view_cart')
            .then(function (response) {
            let  user_data = response.data.cart_data;
                alldata=user_data;
                reload();
            })
        }

        function reload()
        {
            cart_data.innerHTML='';

            alldata.forEach(function(data) { 
                cart_data.innerHTML +=
                `<tr>
                    <td class="cart_product_img">
                        <a href="#"><img src="{{ asset('user/img/product-img/oneplus/9rt.jpeg') }}" alt="Product"></a>
                    </td>
                    <td class="cart_product_desc">
                        <h5>${data.name}</h5>
                    </td>
                    <td class="price">
                        <span>${data.price}</span>
                    </td>
                    <td class="qty">
                        <div class="qty-btn d-flex">
                            <p>Qty</p>
                            <div class="quantity">                          
                                <span class="qty-minus mr-2" onclick="minusButton(${data.id})"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                <input type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="quantity" value="${data.quantity }">
                                <span class="qty-plus" onclick="plusButton(${data.id})"><i class="fa fa-plus" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="remove(${data.id})">x</button>
                    </td>
                </tr>`
            }); 
        }

        function minusButton(id)
        {
            axios.get(`/update_cart/${id}/-1`)
            .then(function (response) {
                user_data = response.data.cart_data;
                alldata = user_data;
                recall();
             });
        }
        function plusButton(id)
        {
            axios.get(`/update_cart/${id}/+1`)
            .then(function (response) {
                user_data = response.data.cart_data;
                alldata = user_data;
                recall();
             });
        }

        function remove(id)
        {
            axios.get(`/deletecart/${id}`)
            .then(function (response) {
                user_data = response.data.users;
                alldata=user_data;
                recall();
            });

        }
    </script>
@endsection
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
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="cart-summary">
                    <h5>Cart Total</h5>
                    <ul class="summary-table">
                        <li><span>delivery:</span> <span>Free</span></li>
                        <li><span>total:</span> <span id="total"></span></li>
                    </ul>
                    <div class="cart-btn mt-100" id="stock">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        let cart_data = document.getElementById('cart_data');
        let total_text = document.getElementById('total');
        let stock_manage = document.getElementById('stock');
        let alldata='';
        let Grand_total=0;

       window.onload=function() {
             recall();  
        }
        function recall()
        {
            axios.get('/view_cart')
            .then(function (response) {
            let user_data = response.data.cart_data;
            let total = response.data.sub_total.total;
                alldata=user_data;
                Grand_total= total;
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
                            <button class="btn btn-danger btn-sm " ${(data.quantity <= 1) ? 'disabled' : ''} onclick="minusButton(${data.id})">-</button>
                            <input type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="quantity" value="${data.quantity }">   
                            <button class="btn btn-success btn-sm" ${(data.quantity >= data.stock) ? 'disabled' : ''} onclick="plusButton(${data.id})">+</button>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="remove(${data.id})">x</button>
                    </td>
                </tr>`
            }); 
                total_text.innerHTML = `${Grand_total ?? '0'}`;

                stock_manage.innerHTML =
                `<a href="cart.html" onclick="stockMaintain()" class="btn amado-btn w-100">Checkout</a> `
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

        function stockMaintain()
        {

        }
    </script>
@endsection
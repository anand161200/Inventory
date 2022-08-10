@extends('client_side.include.user_layout')
@section('content')

    <style>
        .error {
        color: #F00;
        background-color: #FFF;
        }
    </style>
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <form action="{{ route('store_order') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-title">
                            <h2>Checkout</h2>
                        </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="first_name" value="" placeholder="First Name">

                                    <span class="error">
                                        @error('first_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="last_name" value="" placeholder="Last Name">
                                    <span class="error">
                                        @error('last_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="">
                                    <span class="error">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                
                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control mb-3" name="address" placeholder="Address" value="">
                                    <span class="error">
                                        @error('address')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="zipCode" placeholder="Zip Code" value="">
                                    <span class="error">
                                        @error('zipCode')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="number" class="form-control" name="contact" min="0" placeholder="Phone No" value="">
                                    <span class="error">
                                        @error('contact')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="cart-summary">
                        <h5>Cart Total</h5>
                        <ul class="summary-table">
                            <li><span>delivery:</span> <span>Free</span></li>
                            {{-- <li><span>item:</span> <span id="item_name"></span></li> --}}
                            <input type="hidden" name="amount" id="amount">
                            <li><span>total:</span> <span id="total"></span></li>
                        </ul>

                        <div class="payment-method">
                            <!-- Cash on delivery -->
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="cod" checked>
                                <label class="custom-control-label" for="cod">Cash on Delivery</label>
                            </div>
                        </div>

                        <div class="cart-btn mt-100">
                            {{-- <a href="#" class="btn amado-btn w-100">Checkout</a> --}}
                            <button type="submit" class="btn amado-btn w-100">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        let total_text = document.getElementById('total');
        let item_name = document.getElementById('item_name');
        let amount = document.getElementById('amount');
        let alldata='';
        let result =[];

       
            axios.get('/checkout')
            .then(function (response) {
            let user_data = response.data.cart_data;
            let total = response.data.sub_total.total;
                alldata=user_data;
                Grand_total= total;
                reload();
            })

        function reload()
        {
            // item_name.innerHTML ="";
            // alldata.forEach(function(data) { 
            //      item_name.innerHTML  += `${data.name}`;
            // });

            amount.value = Grand_total;
            total_text.innerHTML = `${Grand_total ?? '0'}`;
        }
    </script>
@endsection
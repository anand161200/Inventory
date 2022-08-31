@extends('client_side.include.user_layout')
@section('content')
<div class="amado_product_area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="jumbotron text-center">
                    <h1 class="display-3">Thank You!</h1>
                     <hr>
                    <p class="lead">
                      <a class="btn btn-primary btn-sm" href="{{route('home')}}" role="button">Continue to homepage</a>
                    </p>
                  </div>
            </div>
        </div>
        <div class="row">
            {{-- @dump($view_order); --}}
               <table class="table">
                <thead>
                    <tr>
                        <th>Order number</th>
                        <th>Email</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ( $view_order as  $data)
                    @foreach ($data->orders as $item )
                    <tr>
                        <td>{{$item->order_number}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->amount}}</td>
                    </tr>
                    @endforeach
                 @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>   
@endsection
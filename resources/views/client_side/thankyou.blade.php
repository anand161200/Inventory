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
                        <th>Name</th>
                        <th>Price</th>
                        <th>quantity</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ( $view_order as  $data)
                    <tr>
                     <td>{{$data->name}}</td>
                     <td>{{$data->price}}</td>
                     <td>{{$data->quantity}}</td>
                    </tr>
                 @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>   
@endsection
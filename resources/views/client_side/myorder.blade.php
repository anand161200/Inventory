@extends('client_side.include.user_layout')
@section('content')

<div class="amado_product_area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        {{-- <th>Order Date</th> --}}
                        <th>Email</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ( $view_order as  $data)
                    <tr>
                        <td>{{$data->order_number}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->amount}}</td>
                        <td><a href="my_order_details/{{ $data->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                    </tr>
                 @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> 
@endsection
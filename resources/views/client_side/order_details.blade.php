@extends('client_side.include.user_layout')
@section('content')

<div class="amado_product_area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($order_detail as  $data)
                    @foreach ($data->orderdetails as $item )
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$data->quantity}}</td>
                    </tr>  
                    @endforeach
                 @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> 
@endsection
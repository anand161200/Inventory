@extends('client_side.include.user_layout')
@section('content')
<div class="cart-table-area section-padding-100">
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
    </div>
</div>
@endsection
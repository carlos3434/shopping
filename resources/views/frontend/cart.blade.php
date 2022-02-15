@extends('main')
@section('title', 'Home')

@section('content')
    <!-- Jumbotron Header -->
    <header>
        <div class="row">
            <div class="btn-group btn-breadcrumb">
                <a href="{{ URL::to('/') }}" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                <a href="#" class="btn btn-default">My Cart</a>
            </div>
        </div>
    </header>

    <hr>
<div class="row">
    <div class="col-sm-12 col-md-10 col-md-offset-1">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Car</th>
                <th>Quantity</th>
                <th class="text-center">Price</th>
                <th class="text-center">Total</th>
                <th> </th>
            </tr>
            </thead>
            <tbody>
            @foreach($cars as $car)
            <tr id="item-{{ $car->id }}">
                <td class="col-md-6">
                    <div class="media">
                        <img class=" thumbnail pull-left media-object" src="{{ '/files/'.$car->car->image }}" style="width: 72px; height: 72px;">
                        <div class="media-body">
                            <h4 class="media-heading"><a href="#">{{ $car->car->title }}</a></h4>
                            <h5 class="media-heading"><p class="small">{{ $car->car->description }}</p></h5>
                        </div>
                    </div></td>
                <td class="col-md-1" style="text-align: center">
                    <input id="{{ "qty-" . $car->id }}" onkeydown="calculatePrice({{ $car->unit_price}}, {{ $car->id }} )" type="number" class="form-control" id="exampleInputEmail1" value="{{ $car->quantity }}">
                    <small>Press enter to reflect price</small>
                </td>
                <td class="col-md-1 text-center"><strong id="{{ "unit-" . $car->id }}">{{ $car->unit_price }}</strong></td>
                <td class="col-md-1 text-center"><strong id="{{ "total-" . $car->id }}">{{ $car->unit_price }}</strong></td>
                <td class="col-md-1">
                    <button type="button" class="btn btn-danger" onclick="removeFromCart(event, {{ $car->id }})">
                        <span class="glyphicon glyphicon-remove"></span> Remove
                    </button></td>
            </tr>
            @endforeach
            @if (count($cars) > 0)


            <tr>
                <td>   </td>
                <td>   </td>
                <td>   </td>
                <td><h3>Total</h3></td>
                <td class="text-right"><h3><strong id="grand-total">$31.53</strong></h3></td>
            </tr>
            <tr>
                <td>   </td>
                <td>   </td>
                <td>   </td>
                <td>
                    <a href="{{ URL::to('/') }}">
                        <button type="button" class="btn btn-default">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                        </button>
                    </a>
                    </td>
                <td>
                    <a href="{{ URL::to('checkout') }}">
                        <button type="button" class="btn btn-success">
                            Checkout <span class="glyphicon glyphicon-play"></span>
                        </button>
                    </a>
                    </td>
            </tr>
            @else
                <tr><td>0 item(s) in the cart</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<!-- /.row -->
<hr>
@endsection
@section('scripts')
    <script src="{{ URL::asset('js/car.js') }}"></script>
@stop
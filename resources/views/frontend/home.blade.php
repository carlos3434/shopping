@extends('main')
@section('title', 'Home')

@section('content')
<!-- Jumbotron Header -->
<header>
    <h1>Marketplace Cars!</h1>
</header>

<hr>

<!-- Title -->
<div class="row">
    <div class="col-lg-12">
        <h3>Cars</h3>
    </div>
</div>
<!-- /.row -->

    <!-- Page Features -->
    <div class="row text-center">
        @foreach ($cars as $car)
            <div class="col-md-2 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <a href="{{ URL::to('car') . '/' .$car->id }}">
                        <img style="width: 150px; height: 150px;" src="@if(!empty($car->image)){{ 'files/'.$car->image }} @else http://placehold.it/800x500 @endif" alt="">
                    </a>
                    <div class="caption">
                        <h3>{{ $car->title }}</h3>
                        <p>{{ $car->description }}</p>
                        <span class="btn btn-primary">Price: ${{ $car->original_price }}</span>
                        <p>
                            <a id="add-cart-{{$car->id}}" href="Javascript:void(0)" onclick="addToCart(event, {{$car->id}})" class="btn btn-primary">Add to cart!</a>
                            <a href="{{ URL::to('car') . '/' .$car->id }}" class="btn btn-default">View Details</a>
                        <div class="alert" style="display: none" id="notify-{{$car->id}}">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <p id="notify-msg"></p>
                        </div>
                        </p>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $cars->links() }}
    <p>
        Displaying {{$cars->count()}} of {{ $cars->total() }} car(s).
    </p>

<!-- /.row -->
<hr>
@endsection
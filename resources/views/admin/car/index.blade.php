@extends('main')

@section('content')
    @include('admin.sidebar')

    <div class="col-sm-9 col-md-9">
        <table class="table table-striped custab">
            <div class="alert" style="display: none" id="notify">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <p id="notify-msg"></p>
            </div>
            <thead>
                <a href="{{ URL::to('admin/car/create') }}" class="btn btn-primary btn-xs pull-right"><b>+</b> Add new car</a>
                <tr>
                    <th>Title</th>
                    <th>original_price</th>
                    <th>status</th>
                    <th>quantity</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            @if ( ! empty($cars) )
                @foreach($cars as $car)
                    <tr id="car-{{$car['id']}}">
                        <td>{{ $car['title'] }}</td>
                        <td>{{ $car['original_price'] }}</td>
                        <td>{{ $car['status'] }}</td>
                        <td>{{ $car['quantity'] }}</td>
                        <td class="text-center">
                            <a class='btn btn-info btn-xs' href="{{ URL::to('admin/car/'.$car['id'].'/edit') }}"><span class="glyphicon glyphicon-edit"></span> Edit
                            </a>
                            <a href="Javascript:void()" onclick="deleteCar(event, {{$car['id']}});" class="btn btn-danger btn-xs">
                                <span class="glyphicon glyphicon-remove"></span> Del
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
        @if ( ! empty($cars) )
            {{ $cars->links() }}
            <p>
                Displaying {{$cars->count()}} of {{ $cars->total() }} car(s).
            </p>
        @endif
    </div>

@endsection

@section('scripts')
    <script src="{{ URL::asset('js/car.js') }}"></script>
@stop

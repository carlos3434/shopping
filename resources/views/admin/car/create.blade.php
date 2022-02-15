@extends('main')

@section('content')
    <div class="row">
        @include('admin.sidebar')
        <form class="form-horizontal" enctype="multipart/form-data" id="car-create-form">
            <fieldset>
                <legend>Add new car</legend>

                <div class="alert" style="display: none" id="notify">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <p id="notify-msg"></p>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Title</label>
                    <div class="col-md-4">
                        <input id="title" name="title" type="text" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Description</label>
                    <div class="col-md-4">
                        <input id="description" name="description" type="text" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Category</label>
                    <div class="col-md-4">
                        <select name="category_id" id="category_id" class="form-control input-md" required="">
                            @foreach ($categories as $category )
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Original Price</label>
                    <div class="col-md-4">
                        <input id="original_price" name="original_price" type="number" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Actual Price</label>
                    <div class="col-md-4">
                        <input id="actual_price" name="actual_price" type="text" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Image</label>
                    <div class="col-md-4">
                        <input id="image" name="image" type="file" class="form-control input-md" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Quantity</label>
                    <div class="col-md-4">
                        <input id="quantity" name="quantity" type="number" class="form-control input-md" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">model</label>
                    <div class="col-md-4">
                        <input id="model" name="model" type="text" class="form-control input-md" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">size</label>
                    <div class="col-md-4">
                        <input id="size" name="size" type="text" class="form-control input-md" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">registration</label>
                    <div class="col-md-4">
                        <input id="registration" name="registration" type="text" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Status</label>
                    <div class="col-md-4">
                        <input type="radio" name="status" value="1" checked> Yes<br>
                        <input type="radio" name="status" value="0"> No<br>
                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="btn_registrar"></label>
                    <div class="col-md-8">
                        <button onclick="createCar(event)" id="btn_registrar" name="btn_registrar" class="btn btn-success">Create</button>
                        <button id="btn_cancelar" name="btn_cancelar" class="btn btn-danger">Clear</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="{{ URL::asset('js/car.js') }}"></script>
@stop
@extends('main')

@section('content')
    <div class="row">
        @include('admin.sidebar')
        <form class="form-horizontal" enctype="multipart/form-data" id="car-form">
            <fieldset>
                <legend>Edit car</legend>

                <div class="alert" style="display: none" id="notify">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <p id="notify-msg"></p>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Title</label>
                    <div class="col-md-4">
                        <input id="title" name="title" type="text" class="form-control input-md" value="{{ old('title').@$car->title }}" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Description</label>
                    <div class="col-md-4">
                        <input id="description" name="description" type="text" class="form-control input-md" value="{{ old('description').@$car->description }}" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Category</label>
                    <div class="col-md-4">
                        <select name="category_id" id="category_id" class="form-control input-md" required="">
                            @foreach ($categories as $category )
                                <option value="{{ $category->id }}"
                                @if ($category->id == old('category_id', $car->category_id))
                                    selected="selected"
                                @endif
                                >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Original Price</label>
                    <div class="col-md-4">
                        <input id="original_price" name="original_price" type="number" class="form-control input-md" value="{{ old('original_price').@$car->original_price }}" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Actual Price</label>
                    <div class="col-md-4">
                        <input id="actual_price" name="actual_price" type="text" class="form-control input-md" value="{{ old('actual_price').@$car->actual_price }}" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Image</label>
                    <div class="col-md-4">
                        <input id="image" name="image" type="file" class="form-control input-md"   required="">

                        <img style="width: 150px; height: 150px;" src="@if(!empty($car->image)){{ '/files/'.$car->image }} @else http://placehold.it/800x500 @endif" alt="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Quantity</label>
                    <div class="col-md-4">
                        <input id="quantity" name="quantity" type="number" class="form-control input-md" value="{{ old('quantity').@$car->quantity }}" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">model</label>
                    <div class="col-md-4">
                        <input id="model" name="model" type="text" class="form-control input-md" value="{{ old('model').@$car->model }}" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">size</label>
                    <div class="col-md-4">
                        <input id="size" name="size" type="text" class="form-control input-md" value="{{ old('size').@$car->size }}" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">registration</label>
                    <div class="col-md-4">
                        <input id="registration" name="registration" type="text" class="form-control input-md" value="{{ old('registration').@$car->registration }}" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Status</label>
                    <div class="col-md-4">
                        <input type="radio" name="status" id='yes' value="1" {{ ($car->status=='1')?'checked':'' }}><label for="yes">Yes</label><br>
                        <input type="radio" name="status" id='no'  value="0" {{ ($car->status=='0')?'checked':'' }}><label for="no">No</label><br>
                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="btn_registrar"></label>
                    <div class="col-md-8">
                        <button onclick="updateCar(event,{{ $car->id}})" id="btn_registrar" name="btn_registrar" class="btn btn-success">Update</button>
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
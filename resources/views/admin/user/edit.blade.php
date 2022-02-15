@extends('main')

@section('content')
    <div class="row">
        @include('admin.sidebar')
        <form class="form-horizontal" enctype="multipart/form-data" id="user-form">
            <fieldset>
                <legend>Edit User</legend>

                <div class="alert" style="display: none" id="notify">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <p id="notify-msg"></p>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="role_type">Select Role</label>
                    <div class="col-md-4">
                        <select id="role_type" name="role_type" class="form-control">
                            <option value="1" {{ ($user->role_type=='1')?'selected':'' }}>Administrator</option>
                            <option value="2" {{ ($user->role_type=='2')?'selected':'' }}>Customer</option>
                        </select>
                    </div>
                </div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Name</label>
                    <div class="col-md-4">
                        <input id="name" name="name" type="text" class="form-control input-md" value="{{ old('name').@$user->name }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Email</label>
                    <div class="col-md-4">
                        <input id="email" name="email" type="email" class="form-control input-md" value="{{ old('email').@$user->email }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Password</label>
                    <div class="col-md-4">
                        <input id="password" name="password" type="password" class="form-control input-md" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Address</label>
                    <div class="col-md-4">
                        <input id="address" name="address" type="text" class="form-control input-md" value="{{ old('address').@$user->address }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Phone</label>
                    <div class="col-md-4">
                        <input id="phone" name="phone" type="text" class="form-control input-md" value="{{ old('phone').@$user->phone }}">
                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="btn_registrar"></label>
                    <div class="col-md-8">
                        <button onclick="updateUser(event,{{ $user->id}})" id="btn_registrar" name="btn_registrar" class="btn btn-success">Update</button>
                        <button id="btn_cancelar" name="btn_cancelar" class="btn btn-danger">Clear</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="{{ URL::asset('js/user.js') }}"></script>
@stop
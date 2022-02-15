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
                <a href="{{ URL::to('admin/user/create') }}" class="btn btn-primary btn-xs pull-right"><b>+</b> Add new user</a>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created at</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            @if ( ! empty($users) )
                @foreach($users as $user)
                    <tr id="user-{{$user['id']}}">
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['created_at'] }}</td>
                        <td class="text-center">
                            <a class='btn btn-info btn-xs' href="{{ URL::to('admin/user/'.$user['id'].'/edit') }}"><span class="glyphicon glyphicon-edit"></span> Edit
                            </a>
                            <a href="Javascript:void();" onclick="deleteUser(event, {{$user['id']}});" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Del
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    @if ( ! empty($users) )
        {{ $users->links() }}
        <p>
            Displaying {{$users->count()}} of {{ $users->total() }} user(s).
        </p>
    @endif
</div>
@endsection
@section('scripts')
    <script src="{{ URL::asset('js/user.js') }}"></script>
@stop
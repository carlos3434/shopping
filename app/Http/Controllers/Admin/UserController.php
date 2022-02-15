<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Shopping\UserInterface;
use App\Filters\UserFilter;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserDeleteRequest;
/**
 * Class HomeController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserInterface $userRepository )
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request, UserFilter $filters)
    {
        if (!$request->has('page')) {
            $request->request->add(['page' => 1]);
        }
        $users = $this->userRepository->all($filters)->withPath('/admin/users');
        return view('admin.user.index', compact('users') );
    }

    public function show( User $user)
    {
        return $this->userRepository->get($user);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store( UserCreateRequest $request)
    {
        $fields = $request->all();
        $fields['password'] = bcrypt( $request->get('password') );
        $user = $this->userRepository->create( $fields );
        return response()->json($user, 201);
    }

    public function edit(User $user) {
        return view('admin.user.edit',compact('user'));
    }

    public function update( UserUpdateRequest $request, User $user)
    {
        $fields = $request->all();
        if ($request->has('password')) {
            $fields['password'] = bcrypt( $request->get('password') );
        }
        $user = $this->userRepository->update( $fields , $user);
        return response()->json($user, 201);
    }

    public function destroy( UserDeleteRequest $request, User $user)
    {
        $this->userRepository->deleteOne($user);
        return response()->json(null, 204);
    }
}
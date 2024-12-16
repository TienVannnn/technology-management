<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UserRequest;
use App\Models\User;
use App\Http\Services\UserService;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use AuthorizesRequests;
    protected $userService;
    public function __construct(UserService $user)
    {
        $this->userService = $user;
    }


    public function index()
    {
        $this->authorize('list user');
        $title = 'User List';
        $users = $this->userService->getUsers();
        return view('backend.user.list', compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('add user');
        $title = 'Create user';
        $roles = Role::orderByDesc('id')->get();
        return view('backend.user.create', compact('title', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $this->authorize('add user');
        $result = $this->userService->createUser($request);
        if ($result) {
            return redirect()->route('user.index');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('edit user');
        $user = User::find($id);
        if (!$user) {
            abort('404');
        }
        $title = 'Edit user ' . $user->name;
        $rolesChecked = $user->roless->pluck('id')->toArray();
        $roles = Role::orderByDesc('id')->get();
        return view('backend.user.edit', compact('title', 'user', 'rolesChecked', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $this->authorize('edit user');
        $user = User::find($id);
        if (!$user) {
            abort('404');
        }
        $result = $this->userService->updateUser($request, $user);
        if ($result) {
            return redirect()->route('user.index');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete user');
        $user = User::find($id);
        if (!$user) {
            abort('404');
        }
        $this->userService->deleteUser($user);
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UserRequest;
use App\Http\Services\Test;
use App\Models\User;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $user)
    {
        $this->userService = $user;
    }


    public function index()
    {
        $title = 'User List';
        $users = $this->userService->getUsers();
        return view('backend.user.list', compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create user';
        return view('backend.user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
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
        $user = User::find($id);
        if (!$user) {
            abort('404');
        }
        $title = 'Edit user ' . $user->name;
        return view('backend.user.edit', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
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
        $user = User::find($id);
        if (!$user) {
            abort('404');
        }
        $this->userService->deleteUser($user);
        return redirect()->back();
    }
}

<?php

namespace App\Http\Services;

use App\Jobs\MailAccountJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserService
{
    public function getUsers()
    {
        $user = Auth::user();
        if ($user->id === 1) {
            return User::orderByDesc('id')->paginate(15);
        }
        return User::orderByDesc('id')->whereNot('id', 1)->paginate(15);
    }
    public function createUser($request)
    {
        try {
            DB::beginTransaction();
            $rand = rand(100000, 999999);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($rand)
            ]);

            if ($request->has('role')) {
                $user->assignRole($request->role);
            }
            DB::commit();
            Session::flash('success', 'User created successfully');
            MailAccountJob::dispatch($user, $rand)->delay(now()->addSecond(10));
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'User create failed: ' . $e->getMessage());
            return false;
        }
    }

    public function updateUser($request, $user)
    {
        try {
            DB::beginTransaction();
            $user->fill([
                'name' => $request->name,
                'email' => $request->email
            ]);
            if ($request->password) {
                $user->password = $request->password;
            }
            $user->save();
            $user->syncRoles($request->role ?? []);
            DB::commit();
            Session::flash('success', 'User updated successfully');
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'User update failed: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteUser($user)
    {
        $user->delete();
        return;
    }
}

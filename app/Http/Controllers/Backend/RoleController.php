<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\RoleRequest;
use App\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('list role');
        $title = 'Role List';
        $roles = Role::orderByDesc('id')->paginate(10);
        return view('backend.role.list', compact('title', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('add role');
        $title = 'Role create';
        $permissionParent = Permission::where('parent_id', 0)->get();
        return view('backend.role.create', compact('title', 'permissionParent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $this->authorize('add role');
        try {
            DB::beginTransaction();
            $role = Role::create(['name' => $request->name]);
            if ($request->has('permission_id')) {
                $permissions = Permission::whereIn('id', $request->input('permission_id'))->get();
                $role->syncPermissions($permissions);
            }
            DB::commit();
            Session::flash('success', 'Role created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Role create failed ' . $e->getMessage());
        }
        return redirect()->route('role.index');
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
        $this->authorize('edit role');
        $role = Role::find($id);
        if (!$role) abort(404);
        $title = 'Edit role ' . $role->name;
        $permissionChecked = $role->permissions;
        $permissionParent = Permission::where('parent_id', 0)->get();
        return view('backend.role.edit', compact('title', 'role', 'permissionParent', 'permissionChecked'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $this->authorize('edit role');
        try {
            $role = Role::find($id);
            if (!$role) abort(404);
            $role->update(['name' => $request->name]);
            $permissions = Permission::whereIn('id', $request->input('permission_id', []))->get();
            $role->syncPermissions($permissions);
            Session::flash('success', 'Role updated successfully');
        } catch (\Exception $e) {
            Session::flash('error', 'Role update failed ' . $e->getMessage());
        }
        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete role');
        $role = Role::find($id);
        if (!$role) abort(404);
        try {
            $role->delete();
        } catch (\Exception $e) {
            Session::flash('error', 'Role delete failed ' . $e->getMessage());
        }
        return redirect()->back();
    }
}

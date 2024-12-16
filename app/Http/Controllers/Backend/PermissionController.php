<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PermissionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PermissionController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('list permission');
        $title = 'Permission List';
        $permissions = Permission::orderByDesc('id')->paginate(15);
        return view('backend.permission.list', compact('title', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('add permission');
        $title = 'Permission create';
        $permissionParent = Permission::where('parent_id', 0)->get();
        return view('backend.permission.create', compact('title', 'permissionParent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        $this->authorize('add permission');
        try {
            Permission::create([
                'name' => $request->name,
                'parent_id' => $request->parent_id
            ]);
            Session::flash('success', 'Permission created successfully');
        } catch (\Exception $e) {
            Session::flash('error', 'Permission create failed ' . $e->getMessage());
        }
        return redirect()->route('permission.index');
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
        $this->authorize('edit permission');
        $permission = Permission::find($id);
        if (!$permission) abort(404);
        $permissionParent = Permission::where('parent_id', 0)->whereNot('id', $permission->id)->get();
        $title = 'Edit permission ' . $permission->name;
        return view('backend.permission.edit', compact('title', 'permission', 'permissionParent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, string $id)
    {
        $this->authorize('edit permission');
        try {
            $permission = Permission::find($id);
            if (!$permission) abort(404);
            $permission->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id
            ]);
            Session::flash('success', 'Permission updated successfully');
        } catch (\Exception $e) {
            Session::flash('error', 'Permission update failed ' . $e->getMessage());
        }
        return redirect()->route('permission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete permission');
        $permission = Permission::find($id);
        if (!$permission) abort(404);
        try {
            if ($permission->parent_id === 0) {
                Permission::where('parent_id', $permission->id)->delete();
            }
            $permission->delete();
        } catch (\Exception $e) {
            Session::flash('error', 'Permission delete failed ' . $e->getMessage());
        }
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\DepartmentRequest;
use App\Models\Department;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('list department');
        $title = 'Department List';
        $departments = Department::orderByDesc('id')->paginate(15);
        return view('backend.department.list', compact('title', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('add department');
        $title = 'Department create';
        return view('backend.department.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $this->authorize('add department');
        try {
            DB::beginTransaction();
            Department::create([
                'name' => $request->name,
                'status' => $request->status
            ]);
            DB::commit();
            Session::flash('success', 'Department created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Department create failed: ' . $e->getMessage());
        }
        return redirect()->route('department.index');
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
        $this->authorize('edit department');
        $department = Department::find($id);
        if (!$department) abort(404);
        $title = 'Edit department ' . $department->name;
        return view('backend.department.edit', compact('title', 'department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, string $id)
    {
        $this->authorize('edit department');
        $department = Department::find($id);
        if (!$department) abort(404);
        try {
            DB::beginTransaction();
            $department->update([
                'name' => $request->name,
                'status' => $request->status
            ]);
            DB::commit();
            Session::flash('success', 'Department updated successfully');
        } catch (\Exception $e) {
            Session::flash('error', 'Department update failed: ' . $e->getMessage());
        }
        return redirect()->route('department.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete department');
        $department = Department::find($id);
        if (!$department) abort(404);
        try {
            $department->delete();
        } catch (\Exception $e) {
            Session::flash('error', 'Department delete failed: ' . $e->getMessage());
        }
        return redirect()->back();
    }
}

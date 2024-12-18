<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CustomerRequest;
use App\Http\Services\CustomerService;
use App\Jobs\MailAccountJob;
use App\Models\Customer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class CustomerController extends Controller
{
    use AuthorizesRequests;
    protected $customer;
    public function __construct(CustomerService $service)
    {
        $this->customer = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('list customer');
        $title = 'Customer List';
        $customers = Customer::orderByDesc('id')->paginate(10);
        return view('backend.customer.list', compact('title', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('add customer');
        $title = 'Customer create';
        return view('backend.customer.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        $this->authorize('add customer');
        $this->customer->createCustomer($request);
        return redirect()->route('customer.index');
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
        $customer = Customer::find($id);
        if (!$customer) abort(404);
        $title = 'Edit customer ' . $customer->name;
        return view('backend.customer.edit', compact('title', 'customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, string $id)
    {
        $customer = Customer::find($id);
        if (!$customer) abort(404);
        $this->customer->updateCustomer($request, $customer);
        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        if (!$customer) abort(404);
        try {
            $customer->delete();
        } catch (\Exception $e) {
            Session::flash('error', 'Customer delete failed: ' . $e->getMessage());
        }
        return redirect()->back();
    }
}

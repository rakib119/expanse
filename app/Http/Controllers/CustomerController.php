<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_role = auth()->user()->role_id;
        $customers = $this->customerList($user_role);
        return view('common.customer.index', compact('customers'));
    }

    private function customerList($user_role)
    {
        $auth_id =  auth()->id();
        if ($user_role == 2) {
            $condition = ['customers.company_id' => $auth_id];
        }elseif ($user_role == 3 || $user_role == 4){
            $condition = ['customers.created_by' => $auth_id];
        } else{
            abort(403);
        }
        return  Customer::join('users', 'users.id', '=', 'customers.created_by')
            ->where($condition)
            ->orderBy('customers.id', 'desc')
            ->select('users.name as created_by', 'customers.name', 'customers.email', 'customers.phone_number', 'customers.created_at')
            ->get();
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}

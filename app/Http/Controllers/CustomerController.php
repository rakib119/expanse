<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CustomerController extends Controller
{
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
        } elseif ($user_role == 3 || $user_role == 4) {
            $condition = ['customers.created_by' => $auth_id];
        } else {
            abort(403);
        }
        return  Customer::join('users', 'users.id', '=', 'customers.created_by')
            ->where($condition)
            ->orderBy('customers.id', 'desc')
            ->select('users.name as created_by', 'customers.name', 'customers.id', 'customers.email', 'customers.phone_number', 'customers.created_at')
            ->get();
    }

    public function create()
    {
        return view('common.customer.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'max:255',
            'name' => 'max:255',
            'email' => 'max:255',
            'phone_number' => 'max:255',
            'address' => 'max:500',
        ]);

        $user = auth()->user();
        $user_id = $user->id;
        $role_id =  $user->role_id;
        $company_id = $user->company_id;
        $manager_id = $user->manager_id;
        $sels_executive_id = $user->sels_executive_id;
        if ($role_id == 2) {
            $company_id = $user_id;
        } elseif ($role_id == 3) {
            $manager_id = $user_id;
        } elseif ($role_id == 4) {
            $sels_executive_id = $user_id;
        }
        Customer::insertGetId([
            'company_name' => $request->company_name,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->phone_number,
            'company_id' => $company_id,
            'manager_id' => $manager_id,
            'sels_executive_id' => $sels_executive_id,
            'created_by' => $user_id,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Customer created successfully');
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $customer  = Customer::find($id);
        return view('common.customer.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'company_name' => 'max:255',
            'name' => 'max:255',
            'email' => 'max:255',
            'phone_number' => 'max:255',
            'address' => 'max:500',
        ]);

        $customer->company_name =  $request->company_name;
        $customer->name =  $request->name;
        $customer->email =  $request->email;
        $customer->phone_number =  $request->phone_number;
        $customer->address =  $request->address;
        $customer->updated_by =  auth()->id();
        $customer->save();

        return redirect()->route('customer.index')->with('success','customer updated successfully');
    }
}

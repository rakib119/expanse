<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $auth = auth()->user();
        $role_id = $auth->role_id;
        if ($role_id == 1) {
            $users = $this->usersForAdmin($auth);
        } elseif ($role_id == 2) {
            $users =  $this->usersForCompany($auth);
        } elseif ($role_id == 3) {
            $users =  $this->usersForManager($auth);
        }
        return  view('common.user.index', compact('users'));
    }



    public function create()
    {
        return view('common.user.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|max:30',
            'mobile' => 'nullable|max:30',
            'role' => 'required',
            'password' => 'required',
        ]);

        $auth_role = auth()->user()->role_id;
        $error_flag = 0;
        if ($auth_role == 1 && $request->role != 2) {
            $error_flag = 1;
        } elseif ($auth_role == 2 && $request->role != 3) {
            $error_flag = 1;
        } elseif ($auth_role == 3 && $request->role != 4) {
            $error_flag = 1;
        } elseif ($auth_role == 4) {
            abort(404);
        }
        if ($error_flag) {
            return back()->withErrors(['role' => 'Invalid Role']);
        } else {
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->mobile,
                'role_id' => $request->role,
                'password' => Hash::make($request->password),
                'created_at' => now(),
            ]);
            return back()->with('success', 'submited successfully');
        }
    }


    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        //
    }


    public function update(Request $request, User $user)
    {
        //
    }

    
    public function destroy(User $user)
    {
        //
    }

    // method for users
    private function usersForAdmin($auth)
    {
        return User::where('role_id', 2)->orderBy('id', 'desc')->get();
    }

    private function usersForCompany($auth)
    {
        return User::where('company_id', $auth->id)
            ->where(function ($query) {
                return $query->where('role_id', 3)->orWhere('role_id', 4);
            })->orderBy('id', 'desc')->get();
    }

    private function usersForManager($auth)
    {
        return  User::where('company_id', $auth->company_id)
            ->where(['role_id' => 4, 'manager_id' => $auth->id])
            ->orderBy('id', 'desc')->get();
    }

}

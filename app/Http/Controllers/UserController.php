<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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
        $user = auth()->user();
        $user_id = $user->id;
        $role_id =  $user->role_id;
        $company_id = $user->company_id;
        $manager_id = $user->manager_id;
        if ($role_id == 2) {
            $company_id = $user_id;
        } elseif ($role_id == 3) {
            $manager_id = $user_id;
        }

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
                'company_id' =>  $company_id,
                'manager_id' =>  $manager_id,
                'role_id' => $request->role,
                'password' => Hash::make($request->password),
                'created_at' => now(),
            ]);
            return redirect()->route('user.index')->with('success', 'submited successfully');
        }
    }


    public function show(User $user)
    {
    }


    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::find($id);
        return view('common.user.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        if (auth()->id()  == $user->company_id || auth()->user()->company_id  == $user->company_id) {
            $request->validate([
                'name' => 'required|max:20',
                'email' => 'required|max:30',
                'mobile' => 'nullable|max:30',
                'role' => 'required',
            ]);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->mobile;
            $user->role_id = $request->role;
            $user->updated_by = auth()->id();
            $user->save();
            return redirect()->route('user.index')->with('success', 'User updated successfully');
        } else {
            abort(403);
        }
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

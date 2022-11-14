<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // private $role_id = auth()->user()->role_id ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = auth()->user();
        $role_id = $auth->role_id;
        if ($role_id == 1) {
            $users = User::where('role_id', 2)->orderBy('id', 'desc')->get();
        } elseif ($role_id == 2) {
            $users = User::where('company_id', $auth->id)
                ->where(function ($query) {
                    return $query->where('role_id', 3)->orWhere('role_id', 4);
                })
                ->orderBy('id', 'desc')->get();
        }
        return  view('common.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('common.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        }elseif ($auth_role == 2 && $request->role != 3 ) {
            $error_flag = 1;
        }elseif ($auth_role == 3 && $request->role != 4 ) {
            $error_flag = 1;
        }elseif($auth_role==4){
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}

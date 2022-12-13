<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use League\CommonMark\Extension\SmartPunct\DashParser;
use Spatie\FlareClient\Http\Exceptions\NotFound;

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
            'commission' => 'nullable|integer|min:0|max:100',
            'profile_photo' => 'nullable|mimes:jpg,jpeg'
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
            $photo_name = 'avatar-1.jpg';
            if ($request->hasFile('profile_photo')) {
                $photo_name = Str::random(40) . auth()->id() . "." . $request->file('profile_photo')->getClientOriginalExtension();
                $save_link = base_path("public/assets/images/profile/$photo_name");
                Image::make($request->file('profile_photo'))->save($save_link);
            }
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'commission' => $request->commission,
                'phone_number' => $request->mobile,
                'profile_photo' =>  $photo_name,
                'company_id' =>  $company_id,
                'manager_id' =>  $manager_id,
                'role_id' => $request->role,
                'password' => Hash::make($request->password),
                'created_at' => now(),
            ]);

            return redirect()->route('user.index')->with('success', 'submited successfully');
        }
    }


    public function show($id)
    {
        $user  = User::where('id', Crypt::decrypt($id))->first(['role_id', 'id']);
        $user->role_id;
        if ($user->role_id == 3) {
            return DashboardController::managerDashboard($user->id);
        } elseif ($user->role_id == 4) {
            return DashboardController::salesExecutiveDashboard($user->id);
        }
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
                'commission' => 'nullable|integer|min:0|max:100',
                'profile_photo' => 'nullable|mimes:jpg,jpeg'
            ]);
            if ($request->hasFile('profile_photo')) {
                $file_location = public_path("assets/images/profile/$user->profile_photo");
                if ($user->profile_photo != 'avatar-1.jpg' && file_exists($file_location)) {
                    unlink($file_location);
                }
                // get file extention
                $photo_name = Str::random(40) . auth()->id() . "." . $request->file('profile_photo')->getClientOriginalExtension();
                $save_link = base_path("public/assets/images/profile/$photo_name");
                Image::make($request->file('profile_photo'))->save($save_link);
                $user->profile_photo = $photo_name;
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->mobile;
            $user->role_id = $request->role;
            $user->commission = $request->commission;
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
    // change password
    public function changePasswordForm()
    {
        return view('auth.passwords.change');
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|alpha_num|min:8',
            'password_confirmation' => 'required',
        ]);
        $request->validate([
            'password' => 'confirmed',
        ]);
        if ($request->current_password == $request->password) {
            return back()->withErrors(['current_password' => "Current password and New Password can't be same!"]);
        }
        // check password Matched or not
        $value = $request->current_password;
        $hashedValue = auth()->user()->password;
        if (!Hash::check($value, $hashedValue)) {
            return back()->withErrors(['current_password' => "Your Current password is wrong!"]);
        }
        User::find(auth()->id())->update(
            ['password' => bcrypt($request->password)]
        );
        return  back()->with('success', 'password changed successfully');
    }
}

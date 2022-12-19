<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // User::factory(50)->create();
        $time = Carbon::now();
        $password = Hash::make('password');
        $role = [
            ['name' => 'Super admin','email' => 'admin@gmail.com','role_id' => 1,'phone_number' => '01234567895','password'=>$password, 'company_id'=>null ,'manager_id'=>null , 'created_at' => $time,'created_by' => null],
            // ['name' => 'Company','email' => 'company@gmail.com','role_id' => 2,'phone_number' => '01234567474','password'=>$password, 'company_id'=>null ,'manager_id'=>null , 'created_at' => $time,'created_by' => 1],
            // ['name' => 'manager','email' => 'manager@gmail.com','role_id' => 3,'phone_number' => '01234564534','password'=>$password, 'company_id'=>2 ,'manager_id'=>null , 'created_at' => $time,'created_by' => 2],
            // ['name' => 'Sales Executive 1','email' => 'sale1@gmail.com','role_id' => 4,'phone_number' => '01234564545','password'=>$password, 'company_id'=>2 ,'manager_id'=>null , 'created_at' => $time,'created_by' => 3],
            // ['name' => 'Sales Executive 2','email' => 'sale2@gmail.com','role_id' => 4,'phone_number' => '01234564554','password'=>$password, 'company_id'=>2 ,'manager_id'=>null , 'created_at' => $time,'created_by' => 3],
        ];
        DB::table('users')->delete();
        DB::table('users')->insert($role);
    }
}

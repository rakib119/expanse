<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        $role = [
            ['role_id' => 1, 'role_name' => 'Super Admin', 'created_at' => $time],
            ['role_id' => 2, 'role_name' => 'Company', 'created_at' => $time],
            ['role_id' => 3, 'role_name' => 'Manager', 'created_at' => $time],
            ['role_id' => 4, 'role_name' => 'Sales Executive', 'created_at' => $time],
        ];
        DB::table('roles')->delete();
        DB::table('roles')->insert($role);
    }
}

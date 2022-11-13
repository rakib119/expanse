<?php

namespace Database\Seeders;

use App\Models\ExpanseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpanseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExpanseCategory::factory(10)->create();
    }
}

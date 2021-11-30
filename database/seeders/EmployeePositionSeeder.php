<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeePositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_positions')->insert([
            'name' => 'Teacher'
        ]);

        DB::table('employee_positions')->insert([
            'name' => 'Teacher Assistant'
        ]);

        DB::table('employee_positions')->insert([
            'name' => 'Security'
        ]);

        DB::table('employee_positions')->insert([
            'name' => 'Administration'
        ]);
    }
}

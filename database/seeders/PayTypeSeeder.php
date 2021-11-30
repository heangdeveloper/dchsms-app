<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PayTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pay_type')->insert([
            'name' => 'Per Month'
        ]);

        DB::table('pay_type')->insert([
            'name' => 'Per Term'
        ]);
        
        DB::table('pay_type')->insert([
            'name' => 'Per Semester'
        ]);

        DB::table('pay_type')->insert([
            'name' => 'Per Year'
        ]);
    }
}

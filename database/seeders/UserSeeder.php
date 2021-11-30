<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDate = Carbon::now()->toDateString();

        DB::table('users')->insert([
            'fullname' => 'Kimheang Sim',
            'username' => 'admin',
            'email' => 'admin@email.com',
            'campus_id' => '1',
            'role_id' => '1',
            'password' => Hash::make('password'),
            'date_join' => $currentDate,
            'status' => 'active'
        ]);
    }
}

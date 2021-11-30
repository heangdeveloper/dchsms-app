<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('compuses')->insert([
            'name_kh' => 'សាខាសួនយុវវ័ន',
            'name_en' => 'Soun Yuwan Campus'
        ]);

        DB::table('compuses')->insert([
            'name_kh' => 'សាខាសេះស',
            'name_en' => 'Sessor Campus'
        ]);

        DB::table('compuses')->insert([
            'name_kh' => 'សាខាបន្ទាយមានជ័យ',
            'name_en' => 'Banteay Meanchey Campus'
        ]);
    }
}

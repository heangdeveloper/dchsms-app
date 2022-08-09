<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicYear;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AcademicYear::create([
            'year' => '2015'
        ]);

        AcademicYear::create([
            'year' => '2016'
        ]);

        AcademicYear::create([
            'year' => '2017'
        ]);

        AcademicYear::create([
            'year' => '2018'
        ]);

        AcademicYear::create([
            'year' => '2019'
        ]);

        AcademicYear::create([
            'year' => '2020'
        ]);

        AcademicYear::create([
            'year' => '2021'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create([
            'name' => 'Math'
        ]);
        
        Subject::create([
            'name' => 'Phhysics'
        ]);

        Subject::create([
            'name' => 'Chemistry'
        ]);

        Subject::create([
            'name' => 'Biology'
        ]);

        Subject::create([
            'name' => 'Science'
        ]);

        Subject::create([
            'name' => 'Khmer'
        ]);

        Subject::create([
            'name' => 'English'
        ]);

        Subject::create([
            'name' => 'History'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 15; $i++) { 
            Course::insert([
                'name' => strtolower(Str::random(10)),
                'capacity' => rand(3, 8)
            ]);
        }
    }
}

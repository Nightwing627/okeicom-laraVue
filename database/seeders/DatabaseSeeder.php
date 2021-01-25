<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Country;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Manage;
use App\Models\Prefecture;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ApplicationsTableSeeder::class,
            CategorySeeder::class,
            CountrySeeder::class,
            CourseSeeder::class,
            EvaluationsTableSeeder::class,
            LessonSeeder::class,
            MessagesTableSeeder::class,
            ManageSeeder::class,
            PrefectureSeeder::class,
            UserSeeder::class,
        ]);
    }
}

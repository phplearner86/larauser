<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = ['math', 'phyisics', 'chemistry'];

        foreach ($subjects as $subject) {
           factory(App\Subject::class)->create(['name' => $subject]);
        }
    }
}

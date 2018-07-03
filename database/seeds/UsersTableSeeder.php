<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'name' => 'bane',
            'email' => 'b@gmail.com',
            'verified' => true,
        ]);

        factory(App\User::class)->create([
            'name' => 'anja',
            'email' => 'a@gmail.com'
        ]);

        factory(App\User::class, 10)->create();
    }
}

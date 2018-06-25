<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['superadmin', 'admin', 'user'];

        foreach ($roles as $role)
         {
             factory(App\Role::class)->create([
                'name' => $role, 
                'slug' => str_slug($role)
            ]);
         
        }
    }
}

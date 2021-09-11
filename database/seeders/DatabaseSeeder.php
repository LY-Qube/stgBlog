<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
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
        // role and category seeder

        $this->call([
            RoleSeeder::class,
            CategorySeeder::class
        ]);

        // user factory admin
        User::factory()->create([
            'username'  => "admin",
            'role_id'   => Role::where('role','admin')->first()->id
        ]);


        // user publisher and post factory [published 30, unpublished 10, notApproveIt 3]
        User::factory(10)->hasPosts(rand(3,15))
            ->create([
            'role_id'   => Role::where('role','publisher')->first()->id
        ]);

    }
}

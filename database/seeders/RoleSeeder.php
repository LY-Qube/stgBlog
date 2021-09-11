<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'publisher'];

        foreach ($roles as $role) {

            Role::create([
                'role' => $role
            ]);

        }

    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Role;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'uncategorized',
            'Fashion',
            'Food',
            'Travel',
            'Music',
            'Lifestyle',
            'Fitness',
        ];

        foreach ($categories as $category) {

            Category::create([
                'name' => $category
            ]);

        }

    }
}

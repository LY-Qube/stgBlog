<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(10),
            'slug' => $this->faker->slug(10),
            'body' => $this->faker->text,
            'image' => "blog.jpg",
            'category_id' => Category::inRandomOrder()->first()->id,
            'published' => rand(0, 1),
            'approve_at' => (rand(0, 1)) ? now() : null
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    public function configure()
    {
        return $this->afterCreating(
            fn(Post $post) => Comment::factory(rand(0, 10))
                ->for($post)
                ->create(),
        );
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = fake()->dateTime();

        return [
            'title'      => fake()->text(50),
            'body'       => fake()->text(5000),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}

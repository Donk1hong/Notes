<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $collection = collect(['work', 'personal', 'blog', 'default']);

        return [
            'user_id' => User::all()->random()->id,
            'title' => $this->faker->word(),
            'category' => $collection->shuffle()->first(),
            'description' => $this->faker->paragraph(),
        ];
    }
}

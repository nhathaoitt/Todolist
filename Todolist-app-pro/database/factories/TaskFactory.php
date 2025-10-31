<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Task::class;
    public function definition(): array
    {
            //
        $user = User::first();

        return [
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement([
                Task::NOT_STARTED,
                Task::IN_PROGRESS,
                Task::COMPLETED,
            ]),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'user_id' => $user->id
        ];
    }
}

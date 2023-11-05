<?php

namespace Database\Factories;

use App\Enums\TaskStatusEnum;
use App\Models\Label;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->realTextBetween(10, 30),
            'description' => $this->faker->realTextBetween(100, 255),
            'status' => $this->faker->randomElement(TaskStatusEnum::values()),
        ];
    }

    public function configure(): Factory
    {
        return $this->afterCreating(function (Task $task) {
            $task->labels()->attach(Label::all()->random(3));
        });
    }
}

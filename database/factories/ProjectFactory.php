<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->realTextBetween(10, 20),
            'description' => $this->faker->realTextBetween(100, 255),
            'tags' => $this->faker->randomElements(['tag1', 'tag2', 'tag3', 'tag4', 'tag5'], $this->faker->numberBetween(0, 5)),
        ];
    }

    public function configure(): Factory
    {
        return $this->afterCreating(function (Project $project) {
            $users = User::all()->random(5);

            $project->users()->attach($users);
            $project->tasks()->each(function (Task $task) use ($users) {
                $task->user()->associate($users->random(1)->first()->id)->save();
            });
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create();

        Label::factory(5)->create();

        Project::factory(20)
            ->has(
                Task::factory()->count(10)
            )
            ->create();
    }
}

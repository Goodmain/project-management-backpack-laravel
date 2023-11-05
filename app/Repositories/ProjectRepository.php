<?php

namespace App\Repositories;

use App\Models\Project;
use RonasIT\Support\Repositories\BaseRepository;

/**
 * @property Project $model
 */
class ProjectRepository extends BaseRepository
{
    public function __construct()
    {
        $this->setModel(Project::class);
    }
}

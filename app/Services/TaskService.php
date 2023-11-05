<?php

namespace App\Services;

use Illuminate\Support\Arr;
use RonasIT\Support\Services\EntityService;
use App\Repositories\TaskRepository;

/**
 * @mixin TaskRepository
 * @property TaskRepository $repository
 */
class TaskService extends EntityService
{
    public function __construct()
    {
        $this->setRepository(TaskRepository::class);
    }

    public function search($filters)
    {
        return $this->repository
            ->searchQuery($filters)
            ->filterByQuery(['name', 'description'])
            ->with(Arr::get($filters, 'with', []))
            ->withCount(Arr::get($filters, 'with_count', []))
            ->getSearchResults();
    }
}

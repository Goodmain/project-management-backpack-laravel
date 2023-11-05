<?php

namespace App\Services;

use Illuminate\Support\Arr;
use RonasIT\Support\Services\EntityService;
use App\Repositories\ProjectRepository;

/**
 * @mixin ProjectRepository
 * @property ProjectRepository $repository
 */
class ProjectService extends EntityService
{
    public function __construct()
    {
        $this->setRepository(ProjectRepository::class);
    }

    public function search($filters)
    {
        return $this->repository
            ->filterByQuery(['name'])
            ->with(Arr::get($filters, 'with', []))
            ->withCount(Arr::get($filters, 'with_count', []))
            ->searchQuery($filters)
            ->getSearchResults();
    }
}

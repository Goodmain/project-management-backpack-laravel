<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
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

    public function update(int $id, array $data): ?Model
    {
        $result = $this->repository->update($id, $data);

        if (Arr::has($data, 'users')) {
            $result->users()->sync($data['users']);
        }

        return $result;
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

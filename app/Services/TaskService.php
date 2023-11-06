<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
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

    public function create(array $data): ?Model
    {
        /** @var Task $result */
        $result = $this->repository->create($data);

        return $this->syncLabels($result, $data);
    }

    public function update(int $id, array $data): ?Model
    {
        /** @var Task $result */
        $result = $this->repository->update($id, $data);

        return $this->syncLabels($result, $data);
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

    protected function syncLabels(Task $task, array $data): ?Model
    {
        if (Arr::has($data, 'labels')) {
            $task->labels()->sync($data['labels']);
        }

        return $task;
    }
}

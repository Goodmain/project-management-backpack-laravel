<?php

namespace App\Services;

use Illuminate\Support\Arr;
use RonasIT\Support\Services\EntityService;
use App\Repositories\LabelRepository;

/**
 * @mixin LabelRepository
 * @property LabelRepository $repository
 */
class LabelService extends EntityService
{
    public function __construct()
    {
        $this->setRepository(LabelRepository::class);
    }

    public function search($filters)
    {
        return $this->repository
            ->searchQuery($filters)
            ->filterByQuery(['name'])
            ->with(Arr::get($filters, 'with', []))
            ->withCount(Arr::get($filters, 'with_count', []))
            ->getSearchResults();
    }
}

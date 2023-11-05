<?php

namespace App\Repositories;

use App\Models\Label;
use RonasIT\Support\Repositories\BaseRepository;

/**
 * @property Label $model
 */
class LabelRepository extends BaseRepository
{
    public function __construct()
    {
        $this->setModel(Label::class);
    }
}

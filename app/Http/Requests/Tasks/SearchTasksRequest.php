<?php

namespace App\Http\Requests\Tasks;

use App\Enums\TaskStatusEnum;
use App\Http\Requests\Request;

class SearchTasksRequest extends Request
{
    public function rules(): array
    {
        return [
            'project_id' => 'integer',
            'user_id' => 'integer',
            'status' => 'string|in:' . TaskStatusEnum::toString(),
            'page' => 'integer',
            'per_page' => 'integer',
            'all' => 'integer',
            'order_by' => 'string',
            'desc' => 'boolean',
            'with' => 'array',
            'query' => 'string|nullable',
            'with.*' => 'string|required',
        ];
    }
}

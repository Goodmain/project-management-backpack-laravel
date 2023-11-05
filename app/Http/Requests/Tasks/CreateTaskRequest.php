<?php

namespace App\Http\Requests\Tasks;

use App\Enums\TaskStatusEnum;
use App\Http\Requests\Request;

class CreateTaskRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'status' => 'string|in:' . TaskStatusEnum::toString(),
            'project_id' => 'required|integer|exists:projects,id',
            'user_id' => 'nullable|integer|exists:users,id',
            'labels' => 'nullable|array',
            'labels.*' => 'integer|exists:labels,id',
        ];
    }
}

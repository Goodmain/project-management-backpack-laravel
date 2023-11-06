<?php

namespace App\Http\Requests\Tasks;

use App\Enums\TaskStatusEnum;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Services\TaskService;
use App\Http\Requests\Request;

class UpdateTaskRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'string',
            'description' => 'string',
            'status' => 'string|in:' . TaskStatusEnum::toString(),
            'user_id' => 'nullable|integer|exists:users,id',
        ];
    }

    public function validateResolved(): void
    {
        parent::validateResolved();

        $service = app(TaskService::class);

        if (!$service->exists($this->route('id'))) {
            throw new NotFoundHttpException(__('validation.exceptions.not_found', ['entity' => 'Task']));
        }
    }
}

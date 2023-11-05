<?php

namespace App\Http\Requests\Tasks;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Services\TaskService;
use App\Http\Requests\Request;

class GetTaskRequest extends Request
{
    public function rules(): array
    {
        return [
            'with' => 'array',
            'with.*' => 'string|required',
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

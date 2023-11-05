<?php

namespace App\Http\Requests\Projects;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Services\ProjectService;
use App\Http\Requests\Request;

class GetProjectRequest extends Request
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

        $service = app(ProjectService::class);

        if (!$service->exists($this->route('id'))) {
            throw new NotFoundHttpException(__('validation.exceptions.not_found', ['entity' => 'Project']));
        }
    }
}

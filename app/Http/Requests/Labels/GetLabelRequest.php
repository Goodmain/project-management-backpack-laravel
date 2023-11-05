<?php

namespace App\Http\Requests\Labels;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Services\LabelService;
use App\Http\Requests\Request;

class GetLabelRequest extends Request
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

        $service = app(LabelService::class);

        if (!$service->exists($this->route('id'))) {
            throw new NotFoundHttpException(__('validation.exceptions.not_found', ['entity' => 'Label']));
        }
    }
}

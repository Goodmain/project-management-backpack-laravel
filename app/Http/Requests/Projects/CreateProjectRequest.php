<?php

namespace App\Http\Requests\Projects;

use App\Http\Requests\Request;

class CreateProjectRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'tags' => 'array',
        ];
    }
}

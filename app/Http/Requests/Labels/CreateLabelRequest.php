<?php

namespace App\Http\Requests\Labels;

use App\Http\Requests\Request;

class CreateLabelRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }
}

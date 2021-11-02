<?php

namespace App\Http\Requests\v1;

use App\PredictionStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property string $status
 */
class UpdatePredictionStatusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => [
                'required',
                'string',
                Rule::in(PredictionStatus::getAllValues())
            ]
        ];
    }
}

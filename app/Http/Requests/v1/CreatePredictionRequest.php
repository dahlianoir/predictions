<?php

namespace App\Http\Requests\v1;

use App\PredictionMarketType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property int $event_id
 * @property string $market_type
 * @property string $prediction
 */
class CreatePredictionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'event_id' => ['required', 'int'],
            'market_type' => ['required', 'string', Rule::in(PredictionMarketType::getAllValues())],
            'prediction' => [
                'required',
                'string',
                Rule::when(
                    $this->market_type === PredictionMarketType::MARKET_TYPE_1X2,
                    ['in:1,X,2']
                ),
                Rule::when(
                    $this->market_type === PredictionMarketType::MARKET_TYPE_CORRECT_SCORE,
                    ['regex:/\d+:\d+/']
                )
            ],
        ];
    }
}

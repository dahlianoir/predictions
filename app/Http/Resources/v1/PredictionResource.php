<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property int $event_id
 * @property string $market_type
 * @property string $prediction
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class PredictionResource extends JsonResource
{
    /**
     * @inheritdoc
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'event_id' => $this->event_id,
            'market_type' => $this->market_type,
            'prediction' => $this->prediction,
            'status' => $this->status,
        ];
    }
}

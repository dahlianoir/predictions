<?php

namespace App\Models;

use App\PredictionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $event_id
 * @property string $market_type
 * @property string $prediction
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class Prediction extends Model
{
    use HasFactory;

    /**
     * @inheritdoc
     */
    protected $fillable = ['event_id', 'market_type', 'prediction'];

    /**
     * @inheritdoc
     */
    protected static function booted()
    {
        static::creating(function ($prediction) {
            $prediction->status = PredictionStatus::STATUS_UNRESOLVED;
        });
    }
}

<?php

namespace Database\Factories;

use App\PredictionMarketType;
use App\PredictionStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class PredictionFactory extends Factory
{
    /**
     * @inheritdoc
     */
    public function definition()
    {
        $marketType = $this->faker->randomElement(PredictionMarketType::getAllValues());

        $prediction = match ($marketType) {
            PredictionMarketType::MARKET_TYPE_CORRECT_SCORE =>
                $this->faker->numberBetween() . ':' . $this->faker->numberBetween(),
            PredictionMarketType::MARKET_TYPE_1X2 => $this->faker->randomElement(['1', '2', 'X']),
        };

        return [
            'event_id' => $this->faker->numberBetween(),
            'market_type' => $marketType,
            'prediction' => $prediction,
            'status' => $this->faker->randomElement(PredictionStatus::getAllValues())
        ];
    }
}

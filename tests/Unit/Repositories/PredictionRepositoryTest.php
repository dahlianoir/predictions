<?php

namespace Tests\Unit\Repositories;

use App\Models\Prediction;
use App\Repositories\PredictionRepository;
use Tests\TestCase;

class PredictionRepositoryTest extends TestCase
{
    public function testCreate(): void
    {
        /** @var Prediction $prediction */
        $prediction = Prediction::factory()->make();

        $repository = new PredictionRepository();
        $repository->create(
            [
                'event_id' => $prediction->event_id,
                'market_type' => $prediction->market_type,
                'prediction' => $prediction->prediction
            ]
        );

        $this->assertDatabaseHas('predictions', [
            'event_id' => $prediction->event_id,
            'market_type' => $prediction->market_type,
            'prediction' => $prediction->prediction,
            'status' => 'unresolved'
        ]);
    }

    public function testUpdateStatus(): void
    {
        $prediction = Prediction::factory()->state(['status' => 'unresolved'])->create();

        $repository = new PredictionRepository();
        $repository->updateStatus($prediction, 'won');

        $this->assertDatabaseHas('predictions', [
            'id' => $prediction->id,
            'status' => 'won'
        ]);
    }

    public function testIndex(): void
    {
        Prediction::factory()->count(3)->create();

        $repository = new PredictionRepository();
        $result = $repository->index();

        $this->assertCount(3, $result);
    }
}

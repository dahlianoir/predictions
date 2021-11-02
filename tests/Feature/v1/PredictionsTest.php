<?php

namespace Tests\Feature\v1;

use App\Models\Prediction;
use Tests\TestCase;

class PredictionsTest extends TestCase
{
    public function testIndex(): void
    {
        Prediction::factory()->count(3)->create();

        $response = $this->get('/v1/predictions', ['Accept' => 'application/json']);

        $response
            ->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function testCreate(): void
    {
        $response = $this->postJson('/v1/predictions', [
            'event_id' => 1,
            'market_type' => 'correct_score',
            'prediction' => '3:2'
        ]);

        $response->assertNoContent();
        $this->assertDatabaseHas('predictions', [
            'event_id' => 1,
            'market_type' => 'correct_score',
            'prediction' => '3:2'
        ]);
    }


    public function testUpdateStatus(): void
    {
        $prediction = Prediction::factory()->create();

        $response = $this->putJson("/v1/predictions/{$prediction->id}/status", [
            'status' => 'lost'
        ]);

        $response->assertNoContent();
        $this->assertDatabaseHas('predictions', [
            'id' => $prediction->id,
            'status' => 'lost'
        ]);
    }
    
    public function testCreateValidationErrors(): void
    {
        $response = $this->postJson('/v1/predictions', [
            'event_id' => $this->faker->word,
            'market_type' => $this->faker->word,
            'prediction' => $this->faker->word
        ]);

        $response->assertStatus(400);
    }

    public function testUpdateValidationError(): void
    {
        $prediction = Prediction::factory()->create();

        $response = $this->putJson("/v1/predictions/{$prediction->id}/status", [
            'status' => 'invalid'
        ]);

        $response->assertStatus(400);
    }

    public function testUpdateNonexistent(): void
    {
        $id = $this->faker->numberBetween(999);

        $response = $this->putJson("/v1/predictions/{$id}/status", [
            'status' => 'invalid'
        ]);

        $response->assertStatus(404);
    }
}

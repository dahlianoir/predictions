<?php

namespace App\Services;

use App\Models\Prediction;
use App\Repositories\PredictionRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class PredictionService
{
    public function __construct(private PredictionRepository $predictionRepository)
    {
    }

    public function create(array $attributes): void
    {
        Log::debug("Creating prediction", $attributes);

        $this->predictionRepository->create($attributes);
    }

    public function index() : Collection
    {
        return $this->predictionRepository->index();
    }

    public function updateStatus(Prediction $prediction, string $status): void
    {
        Log::debug("Updating status of prediction id {$prediction->id} to $status");
        
        $this->predictionRepository->updateStatus($prediction, $status);
    }
}

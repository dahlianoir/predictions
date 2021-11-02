<?php

namespace App\Repositories;

use App\Models\Prediction;
use Illuminate\Support\Collection;

class PredictionRepository
{
    public function create(array $attributes): void
    {
        $prediction = new Prediction();
        $prediction->fill($attributes);
        $prediction->save();
    }

    public function updateStatus(Prediction $prediction, string $status): void
    {
        $prediction->status = $status;
        $prediction->save();
    }

    public function index(): Collection
    {
        return Prediction::all();
    }
}

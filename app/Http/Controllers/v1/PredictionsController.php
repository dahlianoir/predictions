<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\CreatePredictionRequest;
use App\Http\Requests\v1\UpdatePredictionStatusRequest;
use App\Http\Resources\v1\PredictionResource;
use App\Models\Prediction;
use App\Services\PredictionService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class PredictionsController extends Controller
{
    public function __construct(private PredictionService $predictionService)
    {
    }

    public function create(CreatePredictionRequest $request): Response
    {
        $this->predictionService->create($request->validated());

        return new Response('', HttpResponse::HTTP_NO_CONTENT);
    }

    public function index(): AnonymousResourceCollection
    {
        return PredictionResource::collection($this->predictionService->index());
    }

    public function updateStatus(
        Prediction $prediction,
        UpdatePredictionStatusRequest $updatePredictionStatusRequest
    ): Response {
        $this->predictionService->updateStatus($prediction, $updatePredictionStatusRequest->status);

        return new Response('', HttpResponse::HTTP_NO_CONTENT);
    }
}

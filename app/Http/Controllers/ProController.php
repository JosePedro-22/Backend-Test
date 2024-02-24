<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProFormRequest;
use App\Http\Resources\SummaryDataResource;
use App\Services\ScorerInterface;
use Illuminate\Http\JsonResponse;
use Throwable;

class ProController extends Controller
{

    public function __construct(
        private readonly ScorerInterface $scorer
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function selectProject(ProFormRequest $request): JsonResponse
    {
        try {
            $response = $this->scorer->searchingForSummaryData($request->validated());
            return (new SummaryDataResource($response))->response();
        } catch (Throwable $throwable) {
            $this->badRequestResponse($throwable);
        }
    }
}

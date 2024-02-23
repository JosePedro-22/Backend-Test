<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProFormRequest;
use App\Http\Resources\SummaryDataResource;
use App\Repositories\ScorerInterface;
use Throwable;

class ProController extends Controller
{
    private ScorerInterface $scorer;

    public function __construct(ScorerInterface $scorer)
    {
        $this->scorer = $scorer;
    }

    /**
     * @throws Throwable
     */
    public function selectProject(ProFormRequest $request): SummaryDataResource
    {
        try {
            return $this->scorer->searchingForSummaryData($request->validated());
        }catch (Throwable $throwable){
            $this->badRequestResponse($throwable);
        }
    }
}

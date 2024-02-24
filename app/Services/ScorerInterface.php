<?php

namespace App\Services;

use App\Http\Resources\GetIneligibleOrEligibleProResource;

interface ScorerInterface
{
    public function calculateScore(array $data): int;

    public function selectProjectBasedOnScore(int $score): ?string;

    public function getIneligibleAndEligibleProjects(int $score): array;
}


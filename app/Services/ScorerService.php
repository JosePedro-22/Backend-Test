<?php

namespace App\Services;

use Illuminate\Support\Arr;

class ScorerService implements ScorerInterface
{
    use Score;
    private array $projects = [
        'calculate_dark_matter_nasa' => 10,
        'determine_schrodinger_cat_is_alive' => 5,
        'support_users_from_xyz' => 3,
        'collect_information_for_xpto' => 2
    ];

    public function SearchingForSummaryData($requestData): array
    {
        $score = $this->calculateScore($requestData);
        $selectedProject = $this->selectProjectBasedOnScore($score);
        $getData = $this->getIneligibleAndEligibleProjects($score);
        $eligibleProject = Arr::get($getData, 'eligible_projects');
        $ineligibleProject = Arr::get($getData, 'ineligible_projects');

        return [
            'score' => $score,
            'selected_project' => $selectedProject,
            'eligible_projects' => $eligibleProject,
            'ineligible_projects' => $ineligibleProject
        ];
    }

    public function selectProjectBasedOnScore(int $score): ?string
    {
        foreach ($this->projects as $project => $requiredScore) {
            if ($score > $requiredScore) return $project;
        }
        return null;
    }

    public function getIneligibleAndEligibleProjects(int $score): array
    {
        $ineligibleProjects = [];
        $eligibleProjects = [];

        foreach ($this->projects as $project => $requiredScore) {
            if ($score <= $requiredScore) $ineligibleProjects[] = $project;
            else $eligibleProjects[] = $project;
        }

        return [
            'eligible_projects' => $eligibleProjects,
            'ineligible_projects' => $ineligibleProjects,
        ];
    }
}

<?php

namespace App\Services;

use App\Http\Resources\SummaryDataResource;
use App\Repositories\ProScorerRepository;
use App\Repositories\ScorerInterface;
use Illuminate\Support\Arr;

class ScorerService implements ScorerInterface
{
    protected array $projects;
    public function __construct()
    {
        $this->projects = [
            'calculate_dark_matter_nasa' => 10,
            'determine_schrodinger_cat_is_alive' => 5,
            'support_users_from_xyz' => 3,
            'collect_information_for_xpto' => 2
        ];
    }
    public function SearchingForSummaryData($requestData): SummaryDataResource
    {
        $score = $this->calculateScore($requestData);
        $selectedProject = $this->selectProjectBasedOnScore($score);
        $getData = $this->getIneligibleAndEligibleProjects($score);
        $eligibleProject = Arr::get($getData, 'eligible_projects');
        $ineligibleProject = Arr::get($getData, 'ineligible_projects');

        return new SummaryDataResource([
            'score' => $score,
            'selected_project' => $selectedProject,
            'eligible_projects' => $eligibleProject,
            'ineligible_projects' => $ineligibleProject
        ]);
    }
    public function calculateScore(array $data): int
    {
        $score = 0;

        $age = Arr::get($data, 'age');
        $education_sales = Arr::get($data, 'education_level.sales');
        $education_support = Arr::get($data, 'education_level.support');
        $internet_download = Arr::get($data, 'internet_test.download_speed');
        $internet_upload = Arr::get($data, 'internet_test.upload_speed');
        $writing_score = Arr::get($data, 'writing_score');
        $referential_code = Arr::get($data, 'referral_code');

        if($age < 18) return $score;

        switch (Arr::get($data, 'education_level')) {
            case 'high_school':
                $score += 1;
                break;
            case 'bachelors_degree_or_high':
                $score += 2;
                break;
        }

        if ($education_sales) $score += 5;

        if ($education_support) $score += 3;

        if ($internet_download > 50) $score += 1;

        else if ($internet_download < 5) $score -= 1;

        if ($internet_upload > 50) $score += 1;

        else if ($internet_upload < 5) $score -= 1;

        if ($writing_score < 0.3) $score -= 1;

        else if ($writing_score >= 0.3 && $writing_score <= 0.7) $score += 1;

        else if ($writing_score > 0.7) $score += 2;

        if ($referential_code == 'token1234') $score += 1;

        return $score;
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

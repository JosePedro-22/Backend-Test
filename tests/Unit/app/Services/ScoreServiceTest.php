<?php

namespace Tests\Unit\app\Services;

use App\Http\Resources\SummaryDataResource;
use App\Services\ScorerService;
use Illuminate\Http\JsonResponse;
use PHPUnit\Framework\TestCase;

class ScoreServiceTest extends TestCase
{
    protected $scorer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->scorer = new ScorerService();
    }

    public function testCalculateScore()
    {
        $data = [
            'age' => 35,
            'education_level' => 'high_school',
            'past_experiences' => [
                'sales' => false,
                'support' => true
            ],
            'internet_test' => [
                'download_speed' => 50.4,
                'upload_speed' => 40.2
            ],
            'writing_score' => 0.6,
            'referral_code' => 'token1234'
        ];

        $expectedScore = 4;

        $score = $this->scorer->calculateScore($data);

        $this->assertEquals($expectedScore, $score);
    }

    public function testSelectProjectBasedOnScore()
    {
        $score = 15;
        $expectedProject = 'calculate_dark_matter_nasa';

        $selectedProject = $this->scorer->selectProjectBasedOnScore($score);

        $this->assertEquals($expectedProject, $selectedProject);
    }

    public function testGetIneligibleAndEligibleProjects()
    {

        $score = 15;
        $expectedEligibleProjects = [
            'calculate_dark_matter_nasa',
            'determine_schrodinger_cat_is_alive',
            'support_users_from_xyz',
            'collect_information_for_xpto'
        ];
        $expectedIneligibleProjects = [];

        $projects = $this->scorer->getIneligibleAndEligibleProjects($score);

        $this->assertEquals($expectedEligibleProjects, $projects['eligible_projects']);
        $this->assertEquals($expectedIneligibleProjects, $projects['ineligible_projects']);
    }

    public function testSearchingForSummaryData()
    {
        $data = [
            'age' => 35,
            'education_level' => 'high_school',
            'past_experiences' => [
                'sales' => false,
                'support' => true
            ],
            'internet_test' => [
                'download_speed' => 50.4,
                'upload_speed' => 40.2
            ],
            'writing_score' => 0.6,
            'referral_code' => 'token1234'
        ];

        $summaryData = $this->scorer->SearchingForSummaryData($data);

        $this->assertIsArray($summaryData);
        $this->assertArrayHasKey('selected_project', $summaryData);
    }
}

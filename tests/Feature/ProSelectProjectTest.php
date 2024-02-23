<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProSelectProjectTest extends TestCase
{
    public function which_projects_the_professional_can_participate_in_and_are_expected_to_be_successful(): void
    {
        $payload = [
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

        $response = $this->postJson('/api/pro/select-project', $payload);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'score',
                'selected_project',
                'eligible_projects',
                'ineligible_projects'
            ]);
    }
}

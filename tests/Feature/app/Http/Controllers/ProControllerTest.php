<?php

namespace Feature\app\Http\Controllers;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class ProControllerTest extends TestCase
{
    public function testWhichProjectsTheProfessionalCanParticipateInAndAreExpectedToBeSuccessful(): void
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

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'score',
            'selected_project',
            'eligible_projects',
            'ineligible_projects'
        ]);
    }

    public function testWhichProjectsTheProfessionalCanParticipateInAndAreExpectedToBeFail(): void
    {
        $payload = [];

        $response = $this->postJson('/api/pro/select-project', $payload);

        $response->assertStatus(422);
        $response->assertJsonStructure([
                'message',
                'errors',
        ]);
    }
    public function testWhichProjectsTheProfessionalCanParticipateInAndAreExpectedToBeFailValidateParams(): void
    {
        $payload = [];

        $response = $this->postJson('/api/pro/select-project', $payload);

        $response->assertStatus(422);
        $response->assertJsonFragment([
            'errors'=>[
                "age"=> ["Age is required."],
                "education_level"=> ["Education level is required."],
                "internet_test.download_speed"=> ["Internet download speed is required."],
                "internet_test.upload_speed"=> ["Internet upload speed is required."],
                "past_experiences.sales"=> ["Past experiences are required."],
                "past_experiences.support"=> ["The past experiences.support field is required."],
                "writing_score"=> ["Writing score is required."],
            ],
        ]);
    }
}

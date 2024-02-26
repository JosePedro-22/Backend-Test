<?php

namespace App\Services;

use Illuminate\Support\Arr;

trait Score
{
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

        if ($age < 18) return $score;

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
}

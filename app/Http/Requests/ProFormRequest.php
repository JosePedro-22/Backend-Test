<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'age' => ['required', 'integer', 'min:0'],
            'education_level' => ['required', 'string', Rule::in(['no_education', 'high_school', 'bachelors_degree_or_high'])],
            'past_experiences.sales' => ['required', 'boolean'],
            'past_experiences.support' => ['required', 'boolean'],
            'internet_test.download_speed' => ['required', 'numeric'],
            'internet_test.upload_speed' => ['required', 'numeric'],
            'writing_score' => ['required', 'numeric', 'between:0,1'],
            'referral_code' => ['nullable', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'age.required' => 'Age is required.',
            'age.integer' => 'Age must be an integer.',
            'age.min' => 'Age must be at least :min.',

            'education_level.required' => 'Education level is required.',
            'education_level.string' => 'Education level must be a string.',
            'education_level.in' => 'The selected education level is invalid.',

            'past_experiences.sales.required' => 'Past experiences are required.',
            'past_experiences.sales.boolean' => 'Past experiences must be an boolean.',

            'internet_test.download_speed.required' => 'Internet download speed is required.',
            'internet_test.download_speed.numeric' => 'Internet download speed must be an numeric.',

            'internet_test.upload_speed.required' => 'Internet upload speed is required.',
            'internet_test.upload_speed.numeric' => 'Internet upload speed must be an numeric.',

            'writing_score.required' => 'Writing score is required.',
            'writing_score.numeric' => 'Writing score must be a number.',
            'writing_score.between' => 'Writing score must be between :min and :max.',

            'referral_code.string' => 'Referral code must be a string.',
        ];
    }
}

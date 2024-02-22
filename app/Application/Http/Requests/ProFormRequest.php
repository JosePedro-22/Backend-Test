<?php

namespace App\Application\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'age' => ['required','integer','min:0'],
            'education_level' => ['required','string','in:no_education,high_school,bachelors_degree_or_high'],
            'past_experiences' => ['required','array'],
            'internet_test' => ['required','array'],
            'writing_score' => ['required','numeric','between:0,1'],
            'referral_code' => ['nullable','string']
        ];
    }

    public function messages(): array
    {
        return [
            'age.required' => '',
            'age.integer' => '',
            'age.min' => '',
            'education_level.required' => '',
            'education_level.string' => '',
            'education_level.in' => '',
            'past_experiences.required' => '',
            'past_experiences.array' => '',
            'internet_test.required' => '',
            'internet_test.array' => '',
            'writing_score.required' => '',
            'writing_score.numeric' => '',
            'writing_score.between' => '',
            'referral_code.nullable' => '',
            'referral_code.string' => '',
        ];
    }
}

<?php

namespace App\Domain\Pro;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pro extends Model
{
    use HasFactory;

    protected $fillable = [
        'age',
        'education_level',
        'past_experiences',
        'internet_test',
        'writing_score',
        'referral_code'
    ];

    protected $casts = [
        'past_experiences' => 'array',
        'internet_test' => 'array',
    ];
}

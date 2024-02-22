<?php

namespace App\Application\Http\Controllers;

use App\Application\Http\Requests\ProFormRequest;
use Illuminate\Support\Arr;

class ProController extends Controller
{
    public function selectProject(ProFormRequest $request)
    {
        $dataValidated = $request->validated();

        dd($dataValidated,
            Arr::get($dataValidated, 'past_experiences.support'),
            Arr::get($dataValidated, 'internet_test.upload_speed')
        );

        return [];
    }
}

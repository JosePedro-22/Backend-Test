<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SummaryDataResource extends JsonResource
{
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
            'score' => $this->resource['score'],
            'selected_project' => $this->resource['selected_project'],
            'eligible_projects' => $this->resource['eligible_projects'],
            'ineligible_projects' => $this->resource['ineligible_projects']
        ];
    }
}

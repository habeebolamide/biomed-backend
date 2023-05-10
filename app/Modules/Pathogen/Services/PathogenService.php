<?php
namespace App\Modules\Pathogen\Services;

use App\Traits\ApiResponseMessagesTrait;
use App\Modules\Pathogen\Models\Pathogen;

class PathogenService 
{
    use ApiResponseMessagesTrait;

    public function createPathogen($data)
    {
       dd($data);
    }
}
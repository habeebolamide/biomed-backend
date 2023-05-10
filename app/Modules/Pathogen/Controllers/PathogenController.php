<?php
namespace App\Modules\Pathogen\Controllers;
use App\Http\Controllers\Controller;
use App\Modules\Pathogen\Requests\PathogenRequest;
use App\Modules\Pathogen\Services\PathogenService;

class PathogenController extends Controller
{
    public function store(PathogenRequest $request)
    {
        return (new PathogenService)->createPathogen($request->validated());
    }
}
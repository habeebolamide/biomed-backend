<?php

namespace App\Modules\BackgroundSlider\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\BackgroundSlider\Models\BackgroundSlider;
use App\Modules\BackgroundSlider\Services\BackgroundSliderService;
use Illuminate\Http\Request;
use App\Modules\BackgroundSlider\Requests\BackgroundSliderRequest;

class BackgroundSliderController extends Controller
{
    public function index(Request $request)
    {
        return (new BackgroundSliderService)->allSlider($request->all());
    }

    public function store(BackgroundSliderRequest $request)
    {
        return (new BackgroundSliderService)->createSlider($request->all());
    }
}
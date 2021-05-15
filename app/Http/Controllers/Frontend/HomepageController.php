<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class HomepageController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('welcome', compact('sliders'));
    }
}

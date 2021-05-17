<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Slider;

class HomepageController extends Controller
{
    public function index()
    {
        $items = Item::paginate(2);
        $sliders = Slider::all();
        $categories = Category::all();
        return view('welcome', compact('items', 'sliders', 'categories'));
    }
}

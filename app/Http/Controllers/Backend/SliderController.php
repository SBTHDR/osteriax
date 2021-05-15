<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('backend.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'image' => 'required|image',
        ]);

        $image = $request->file('image');
        $imageSlug = Str::slug($request->title);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $imageSlug . '-' . $currentDate . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('upload/sliders')) {
                mkdir('upload/sliders', 0777, true);
            }
            $image->move('upload/sliders', $imagename);
        } else {
            $imagename = 'default.png';
        }

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imagename;

        $slider->save();

        session()->flash('success', 'Slider created successfully!');
        return redirect()->route('slider.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('backend.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'image' => 'image',
        ]);

        $image = $request->file('image');
        $imageSlug = Str::slug($request->title);

        $slider = Slider::find($id);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $imageSlug . '-' . $currentDate . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('upload/sliders')) {
                mkdir('upload/sliders', 0777, true);
            }
            $image->move('upload/sliders', $imagename);
        } else {
            $imagename = $slider->image;
        }


        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imagename;

        $slider->save();

        session()->flash('success', 'Slider updated successfully!');
        return redirect()->route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        if (file_exists('upload/sliders/' . $slider->image)) {
            unlink('upload/sliders/' . $slider->image);
        }
        $slider->delete();

        return redirect()->back()->with('success', 'Slider deleted successfully!');
    }
}

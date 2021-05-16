<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        $categories = Category::all();
        return view('backend.item.index', compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.item.create', compact('categories'));
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
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'image' => 'required|image',
        ]);

        $image = $request->file('image');
        $imageSlug = Str::slug($request->name);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $imageSlug . '-' . $currentDate . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('upload/items')) {
                mkdir('upload/items', 0777, true);
            }
            $image->move('upload/items', $imagename);
        } else {
            $imagename = 'defaultitem.png';
        }

        $item = new Item();

        $item->name = $request->name;
        $item->description = $request->description;
        $item->category_id = $request->category_id;
        $item->price = $request->price;
        $item->image = $imagename;

        $item->save();

        session()->flash('success', 'Item created successfully!');
        return redirect()->route('item.index');
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
        $item = Item::findOrFail($id);
        $categories = Category::all();
        return view('backend.item.edit', compact('item', 'categories'));
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
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'image' => 'image',
        ]);

        $item = Item::findOrFail($id);

        $image = $request->file('image');
        $imageSlug = Str::slug($request->name);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $imageSlug . '-' . $currentDate . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('upload/items')) {
                mkdir('upload/items', 0777, true);
            }
            if (file_exists('upload/items/' . $item->image)) {
                unlink('upload/items/' . $item->image);
            }
            $image->move('upload/items', $imagename);
        } else {
            $imagename = $item->image;
        }


        $item->name = $request->name;
        $item->description = $request->description;
        $item->category_id = $request->category_id;
        $item->price = $request->price;
        $item->image = $imagename;

        $item->save();

        session()->flash('success', 'Item updated successfully!');
        return redirect()->route('item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        if (file_exists('upload/items/' . $item->image)) {
            unlink('upload/items/' . $item->image);
        }

        $item->delete();

        session()->flash('success', 'Item deleted successfully!');
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Item;
use App\Http\Requests\ExhibitionRequest;

class SellController extends Controller
{
    public function create()
    {
        $categories = Category::all();

        return view('sell', compact('categories'));
    }

    public function store(ExhibitionRequest $request)
    {
        $imagePath = $request->file('image')->store('items', 'public');

        $item = Item::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'brand' => $request->brand,
            'description' => $request->description,
            'condition' => $request->condition,
            'price' => $request->price,
            'image' => $imagePath,
            'is_sold' => false,
        ]);

        $item->categories()->attach($request->categories);

        return redirect()->route('items.index');
    }
}

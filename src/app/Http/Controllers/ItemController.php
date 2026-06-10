<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Item::query();

        if($request->keyword) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->tab === 'mylist') {

            if (!$user) {
                $items = collect();
            } else {
                $items = $query->whereHas('likes', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })->get();
            }
        } else {

        if ($user) {
            $query->where('user_id', '!=', $user->id);
        }

        $items = $query->get();
        }

        return view('items.index', compact('items'));
    }

    public function mypage()
    {
        if (!auth()->check()) {
            $items = collect();
        } else {
            $user = auth()->user();

            $items = Item::whereHas('likes', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
        }

        return view('items.mypage', compact('items'));
    }

    public function show(int $item_id)
    {
        $item = Item::with('categories')->findOrFail($item_id);

        return view('items.show', compact('item'));
    }
}

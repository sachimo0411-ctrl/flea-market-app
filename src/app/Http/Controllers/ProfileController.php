<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Models\Purchase;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function index(Request $request)
    {
        $user = auth()->user();

        if ($request->page === 'buy') {
            $items = Purchase::where('user_id', $user->id)
            ->with('item')
            ->get()
            ->pluck('item');
        } else {
            $items = $user->items;
        }

        return view('profile.index', compact('user', 'items'));
    }

    public function update(ProfileRequest $request)
    {
        $user =  User::find(auth()->id());

        $imagePath = $user->profile_image;

        if ($request->hasFile('profile_image'))
            $imagePath = $request->file('profile_image')
                    ->store('profiles', 'public');

        $user->update([
            'name' => $request->name,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building_name' => $request->building_name,
            'profile_image' => $imagePath,
        ]);

        return redirect()->route('profile.index');
    }
}

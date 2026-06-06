<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\User;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\AddressRequest;

class PurchaseController extends Controller
{
    public function index(int $item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = auth()->user();

        return view('purchases.index', compact('item', 'user'));
    }

    public function store(PurchaseRequest $request, int $item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = auth()->user();

        Purchase::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'payment_method' => $request->payment_method,
            'postal_code' => $user->postal_code,
            'address' => $user->address . '' . $user->building_name,
        ]);

        $item->update([
            'is_sold' => true,
        ]);

        return redirect()->route('items.index');
    }

    public function addressEdit(int $item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = auth()->user();

        return view('purchases.address', compact('item', 'user'));
    }

    public function addressUpdate(AddressRequest $request, int $item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = User::findOrFail(auth()->id());

        $user->update([
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building_name' => $request->building_name,
        ]);

        return redirect()->route('purchase.index', ['item_id' => $item_id]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\Supplier;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::query()
            ->has('image')
            ->with('supplier', 'image')
            ->get();

        return view('items.index', [
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all()->pluck('name', 'id')->toArray();

        return view('items.create', [
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        $item = Item::create($request->validated());

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->extension();
            $imagePath = $request->file('image')->storeAs('items', 'item-'.$item->id.'.'.$extension, 'public');

            $item->image()->create(['url' => $imagePath]);
        }

        return redirect()->route('items.index')->with('success', 'Item created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $suppliers = Supplier::all()->pluck('name', 'id')->toArray();

        return view('items.show', [
            'item' => $item,
            'suppliers' => $suppliers,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $suppliers = Supplier::all()->pluck('name', 'id')->toArray();

        return view('items.edit', [
            'item' => $item,
            'suppliers' => $suppliers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $data = $request->validated();

        $item->update($data);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->extension();
            $imagePath = $request->file('image')->storeAs('items', 'item-'.$item->id.'.'.$extension, 'public');
            $item->image()->update(['url' => $imagePath]);
        }

        return redirect()->route('items.index')->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully');
    }
}

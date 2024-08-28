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
        $items = Item::all();

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
        // long method
        // $item = Item::create([
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'price' => $request->price,
        //     'quantity' => $request->quantity,
        //     'supplier_id' => $request->supplier_id,
        // ]);

        //since we have validation the the params and variable names are the same
        //we can use the validated method
        $item = Item::create($request->validated());

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->extension();
            $imagePath = $request->file('image')->storeAs('items', 'item-'.$item->id.'.'.$extension, 'public');

            $item->update([
                'image' => $imagePath,
            ]);
        }

        return redirect(route('items.index'));
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

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->extension();
            $imagePath = $request->file('image')->storeAs('items', 'item-'.$item->id.'.'.$extension, 'public');
            $data = array_merge($data, ['image' => $imagePath]);
        }

        //long method
        // $item->update([
        //     'image' => $imagePath,
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'price' => $request->price,
        //     'quantity' => $request->quantity,
        // ]);

        //since we have validation the the params and variable names are the same
        $item->update($data);

        return redirect()->route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}

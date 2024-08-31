<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequisitionRequest;
use App\Http\Requests\UpdateRequisitionRequest;
use App\Models\Item;
use App\Models\Requisition;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $requisitions = Requisition::withCount('items')
            ->where('requisition_date', 'like', '%'.$request->search.'%')
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('requisitions.index', [
            'requisitions' => $requisitions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::all();

        return view('requisitions.create', [
            'items' => $items,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequisitionRequest $request)
    {
        $requisition = Requisition::create([
            'requisition_date' => $request->requisition_date,
            'user_id' => Auth::id(),
        ]);

        foreach($request->items as $item) {
            $requisition->items()->attach($item['id'], ['quantity' => $item['quantity']]);
        }

        return redirect()->route('requisitions.index')->with('success', 'Requisition created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Requisition $requisition)
    {
        return view('requisitions.show', [
            'requisition' => $requisition,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Requisition $requisition)
    {
        $items = Item::all();
        $requisitionItems = $requisition->items->pluck('pivot');

        return view('requisitions.edit', [
            'requisition' => $requisition,
            'items' => $items,
            'requisitionItems' => $requisitionItems,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequisitionRequest $request, Requisition $requisition)
    {
        $requisition->update([
            'requisition_date' => $request->requisition_date,
            'status' => $request->status,
        ]);

        $requisition->items()->detach();

        foreach($request->items as $item) {
            $requisition->items()->attach($item['item_id'], ['quantity' => $item['quantity']]);
        }

        return redirect()->route('requisitions.index')->with('success', 'Requisition updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requisition $requisition)
    {
        $requisition->delete();

        return redirect()->route('requisitions.index')->with('success', 'Requisition deleted successfully');
    }
}

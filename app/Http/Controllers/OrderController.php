<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Item;
use App\Models\Order;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::withCount('items')
            ->where('order_date', 'like', '%'.$request->search.'%')
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('orders.index', [
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all()->pluck('name', 'id')->toArray();
        $items = Item::all();

        return view('orders.create', [
            'items' => $items,
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $order = Order::create([
            'user_id' => Auth::id(),
            'supplier_id' => $request->supplier_id,
            'order_date' => $request->order_date,
        ]);

        foreach($request->items as $item) {
            $order->items()->attach($item['id'], [
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show', [
            'order' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $items = Item::all();
        $orderItems = $order->items->pluck('pivot');
        $suppliers = Supplier::all()->pluck('name', 'id')->toArray();

        return view('orders.edit', [
            'order' => $order,
            'items' => $items,
            'orderItems' => $orderItems,
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update([
            'order_date' => $request->order_date,
            'status' => $request->status,
            'supplier_id' => $request->supplier_id,
        ]);

        $order->items()->detach();

        foreach($request->items as $item) {
            $order->items()->attach($item['item_id'], [
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }
}

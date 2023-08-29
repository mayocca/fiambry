<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Orders/Create', [
            // 'products' => Product::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $order = Order::create([
            'user_id' => $request->user()->id,
            'details' => $request->details,
        ]);

        $allowedProducts = collect($request->allowed_products)
            ->pluck('name')
            ->map(fn (string $name) => Str::transliterate($name))
            ->map(fn (string $name) => Str::lower($name))
            ->map(fn (string $name) => Product::firstOrCreate(['name' => $name]));

        $order->allowedProducts()->sync($allowedProducts->pluck('id')->toArray());

        return Redirect::route('orders.show', $order)->with('success', 'Order created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return Inertia::render('Orders/Show', [
            'order' => $order->load('user'),
            'products_summary' => $order->productsSummary(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return Inertia::render('Orders/Edit', [
            'order' => $order->load('allowedProducts'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update([
            'details' => $request->details,
        ]);

        $order->allowedProducts()->sync($request->allowed_products);

        return Redirect::route('orders.show', $order)->with('success', 'Order updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}

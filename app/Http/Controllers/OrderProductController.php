<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderProductRequest;
use App\Http\Requests\UpdateOrderProductRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class OrderProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Order $order)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Order $order)
    {
        return Inertia::render('Orders/Products/Create', [
            'order' => $order->load([
                'allowedProducts',
                'products' => function ($query) {
                    $query->where('user_id', request()->user()->id);
                },
            ]),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderProductRequest $request, Order $order)
    {
        $order->products()
            ->wherePivot('user_id', $request->user()->id)
            ->sync($request->products);

        return Redirect::route('orders.show', $order)->with('success', 'Products saved.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order, Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order, Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderProductRequest $request, Order $order, Product $product)
    {
        $order->products()
            ->wherePivot('user_id', $request->user()->id)
            ->updateExistingPivot($product->id, [
                'quantity' => $request->quantity,
            ]);

        return redirect()->route('orders.show', $order)->with('success', 'Product updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order, Product $product)
    {
        $order->products()->where('user_id', request()->user()->id)->detach($product->id);

        return redirect()->route('orders.show', $order)->with('success', 'Product removed from order.');
    }
}

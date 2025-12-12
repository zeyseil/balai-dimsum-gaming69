<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderApiController extends Controller
{
    public function index()
    {
        return response()->json(Order::with('menuItem')->get(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'size' => 'required|in:Reguler,Mini',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500',
        ]);

        $order = Order::create($validated);
        return response()->json($order, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order, Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $validated = $request->validate([
            'size' => 'sometimes|in:Reguler,Mini',
            'quantity' => 'sometimes|integer|min:1',
            'notes' => 'sometimes|nullable|string|max:500',
        ]);

        $order->update($validated);
        return response()->json($order, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
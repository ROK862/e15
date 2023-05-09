<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Item;
use DateTime;


class OrdersController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1',
        ], [
            'quantity.required' => 'Please provide a quantity',
            'quantity.integer' => 'Quantity must be an integer',
            'quantity.min' => 'Quantity must be at least 1',
        ]);
    
        // Get the authenticated user instance
        $user = auth()->user();
        
        // Create a new order instance
        $order = new Order;

        // Retrieve the item by id
        $item = Item::findOrFail($request->input('item_id'));

        if (!isset($item)) 
        {
            // We could not find the item on our system.
            return redirect()->route('home')->with('success', 'This item may no longer exist on our system!');
        }

        // Get the expected delivery date by evaluating the delivery estimate from items.
        $now = new DateTime();
        $now->modify("+{$item->maximum_shipping_duration} days");
        $expected_delivery = $now->format('Y-m-d');
        
        // Set the user_id, item_id, quantity and status for the order
        $order->owner_id = $item->user_id;
        $order->user_id = $user->id;
        $order->item_id = $request->input('item_id');
        $order->quantity = $request->input('quantity');
        $order->expected_delivery = $expected_delivery;
        $order->price = $item->price;
        $order->status = 'new';
        
        // Save the order to the database
        $order->save();
        
        // Redirect the user to the home page with a success message
        return redirect()->route('orders.report')->with('success', 'Order placed successfully!');
    }

    public function orders(Request $request) 
    {
        $orders = Order::where('user_id', auth()->user()->id)->get();
        $items = Item::whereIn('id', $orders->pluck('item_id'))->get();


        $order_data = [];
        foreach ($orders as $order) {
            $item = $items->where('id', $order->item_id)->first();

            $order_data[] = [
                'order_id' => $order->id,
                'item_name' => $item->name,
                'item_price' => $item->price,
                'order_quantity' => $order->quantity,
                'expected_delivery' => $order->expected_delivery,
                'total_price' => $order->quantity * $item->price,
            ];
        }

        return view('reports.orders', [
            'order_data' => $order_data,
        ]);
    }
}
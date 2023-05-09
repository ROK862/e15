<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PageController as ControllersPageController;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    /**
    * GET /
    * Renders the home page.
    */
    public function home(Request $request)
    {
        // Get the authenticated user instance
        $user = Auth::user();

        // Get the search input from the request
        $searchInput = $request->input('search-input');

        $products = [];

        // There are two ways we can render the home page. 
        // 1. Find out if the user is loggedin, and render based on the user currently loggedin to check if they own any courses.
        // 2. Render a default template where the user is not loggedin.

        // 1. If the user is loggedin, we must flagg all courses which the user owns.
        if ($user) 
        {
            $userId = $user->id;

            $query = Item::join('users', 'items.user_id', '=', 'users.id')
                        ->select('items.*', 'users.name as user_name', DB::raw('(items.user_id = '.$userId.') as is_owner'));

            // If a search input is provided, filter the results based on the search input
            if ($searchInput) 
            {
                $query->where('items.name', 'LIKE', '%'.$searchInput.'%');
            }

            $products = $query->get();
        } 
        // 2. If the user is not loggedin, we do not need to flag anything.
        else {
            $query = Item::join('users', 'items.user_id', '=', 'users.id')
                        ->select('items.*', 'users.name as user_name');

            // If a search input is provided, filter the results based on the search input
            if ($searchInput) 
            {
                $query->where('items.name', 'LIKE', '%'.$searchInput.'%');
            }

            $products = $query->get();
        }
        
        return view('home', ['products' => $products, 'searchInput' => $searchInput]);
    }



    /**
    * GET /create
    * Display a form which creates a new product.
    */
    public function create(Request $request)
    {
        $products = [];

        return view('pages/create', ['products' => $products]);
    }


    /**
    * GET /create
    * Display a form which creates a new product.
    */
    public function order(Request $request, $id)
    {
        // Retrieve the item with the given id
        $item = Item::find($id);

        if (!$item) {
            // Item not found
            abort(404);
        }

        $products = [$item];

        return view('pages/order', ['products' => $products]);
    }


    /**
    * GET /create
    * Display a form which creates a new product.
    */
    public function edit(Request $request, $id)
    {
        // Retrieve the item with the given id
        $item = Item::find($id);

        if (!$item) {
            // Item not found
            abort(404);
        }

        // Pass the item to the view
        return view('pages/edit', ['item' => $item]);
    }


    /**
    * GET /manage
    * Display product items component with the mode = 'manage'.
    */
    public function manage(Request $request)
    {
        // Get the authenticated user instance
        $user = Auth::user();

        // Get the ID of the authenticated user
        $userId = $user->id;

        $products = Item::where('user_id', $userId)->get();

        return view('pages/manage', ['products' => $products]);
    }

    /**
    * GET /sales
    * Renders a sales report using the orders table.
    */
    public function salesReport()
    {
        // Get the authenticated user instance
        $user = Auth::user();
        
        // Get the orders associated with the user
        $orders = Order::where('owner_id', $user->id)->get();
        
        // Get the items associated with the orders
        $items = Item::whereIn('id', $orders->pluck('item_id'))->get();
        
        // Create an empty array to store the sales data
        $sales_data = [];
        
        // Loop through the items and calculate the sales data for each item
        foreach ($items as $item) {
            $quantity_sold = 0;
            $total_per_order = 0;
            foreach ($orders as $order) {
                if ($order->item_id == $item->id) {
                    $quantity_sold += $order->quantity;
                    $total_per_order += ($order->quantity * $order->price);
                }
            }
            $sales_data[] = [
                'item_name' => $item->name,
                'quantity_sold' => $quantity_sold,
                'total_per_order' => $total_per_order
            ];
        }
        
        // Calculate the total quantity sold and total sales
        $total_quantity_sold = array_sum(array_column($sales_data, 'quantity_sold'));
        $total_sales = array_sum(array_column($sales_data, 'total_per_order'));
        
        return view('reports/sales', [
            'sales_data' => $sales_data,
            'total_quantity_sold' => $total_quantity_sold,
            'total_sales' => $total_sales
        ]);
    }
}
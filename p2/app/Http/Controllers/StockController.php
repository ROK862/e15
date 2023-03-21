<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'stock-symbol' => 'required|string|max:255',
            'purchase-date' => 'required|date',
            'purchase-shares' => 'required|integer|min:1',
        ]);

        dump($request->all());
    }

    public function process (Request $request)
    {
        // Validate the form data using the defined rules.
        $validation = $request->validate([
            'stock-symbol' => 'required|string|max:255',
            'purchase-date' => 'required|date',
            'purchase-shares' => 'required|integer|min:1',
        ]);

        // If validation fails, the code below will not be executed.

        if ($validation) {
            // If validation passed, we should be able to access the key value pairs.
            $symbol = $validation['stock-symbol'];
            $date = $validation['purchase-date'];
            $shares = $validation['purchase-shares'];

            // Enumerate all possible dates in terms of time series data.
            $enum_1 = ApiProvider::enumerate_market_openings($symbol);

            // Date validation against stock time series data.
            if (in_array($date, $enum_1)) {
                // Handle for valid date in terms of time series.

                $current = ApiProvider::request($symbol, "now");
                $purchase = ApiProvider::request($symbol, $date);

                $profit_lost = ($current["price"] - $purchase["price"]) * $shares;

                $message = "Your profit/lost for this stock at the current date and time is: {$profit_lost}, given that the purchase was on {$date}.";
                
                return view('process', ["error"=>false,"message"=>$message,"symbol"=>$symbol, "date"=>$date, "current"=>$current, "records"=>$purchase["records"]]);
            } else {
                // Handle for invalid date in terms of time series.
                $message = "You need to provide a valid trading date which is less than or equal to todays date and does'nt fall under a holiday or weekend.";

                return view('home', ["error"=>true, "message"=>$message, "symbol"=>$symbol, "date"=>$date, "shares"=>$shares]);
            }
        }
    }
}
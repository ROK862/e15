<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::post('/app/results', function (Request $request) {
    
    // Extract the form data from request body.
    $symbol = $request->input('stock-symbol');
    $date = $request->input('purchase-date');
    $shares = $request->input('purchase-shares');

    // Enumerate all possible dates in terms of time series data.
    $enum_1 = AlphaVantageApiServices::enumerate_market_openings($symbol);

    // Date validation against stock time series data.
    if (in_array($date, $enum_1) && $shares > 0) {
        // Handle for valid date in terms of time series.

        $current = AlphaVantageApiServices::request($symbol, "now");
        $purchase = AlphaVantageApiServices::request($symbol, $date);

        $profit_lost = ($current["price"] - $purchase["price"]) * $shares;

        $message = "Your profit/lost for this stock at the current date and time is: {$profit_lost}, given that the purchase was on {$date}.";
        
        return view('results', ["error"=>false,"message"=>$message,"symbol"=>$symbol, "date"=>$date, "current"=>$current, "records"=>$purchase["records"]]);
    } else {
        // Handle for invalid date in terms of time series.
        $message = "You need to provide a valid trading date which is less than or equal to todays date and does'nt fall under a holiday or weekend.";
        
        if ($shares <= 0) {
            $message = "Share cannot be less than or equal to zero.";
        }

        return view('home', ["error"=>true, "message"=>$message, "symbol"=>$symbol, "date"=>$date, "shares"=>$shares]);
    }
});

Route::get('/app/submit', function () {
    return view('welcome');
});
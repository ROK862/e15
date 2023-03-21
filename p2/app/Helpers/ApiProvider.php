<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;

class ApiProvider extends Controller
{
    public static function request ($symbol, $date="now") 
    {   
        $api_key = Config::get("app.alpha_vantage_key");

        try {
            if ($date == "now") {
                $url = "https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol={$symbol}&apikey={$api_key}";
        
                $data = ApiProvider::get($url);
                $latest_price = $data['Global Quote']['05. price'];
    
                return ["symbol" => $symbol, "price"=>$latest_price];
            } else {
                $url = "https://www.alphavantage.co/query?function=TIME_SERIES_DAILY_ADJUSTED&symbol={$symbol}&apikey={$api_key}&outputsize=full";
    
                $data = ApiProvider::get($url);
                $date_data = $data['Time Series (Daily)'][$date];
                $stock_price = $date_data['4. close'];
                
                $keys = array_keys($data['Time Series (Daily)']);
                $records = [];
    
                foreach($keys as $key) 
                {
                    $data['Time Series (Daily)'][$key]["0. date"] = $key;
                    $records[] = $data['Time Series (Daily)'][$key];
                }
    
                return ["symbol" => $symbol, "price" => $stock_price, "records" => $records];
            }
        } catch (Exception $ex) {
            return ["error"=>$ex, "symbol" => $symbol, "price" => 0, "records" => []];
        }

    }

    public static function enumerate_market_openings($symbol)
    {
        $api_key = Config::get("app.alpha_vantage_key");

        $url = "https://www.alphavantage.co/query?function=TIME_SERIES_DAILY_ADJUSTED&symbol={$symbol}&apikey={$api_key}&outputsize=full";
        
        try {
            $data = ApiProvider::get($url);
            $date_data = $data['Time Series (Daily)'];

            return array_keys($date_data);
        } catch (Exception $ex) {
            return [];
        }
    }

    private static function get ($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
    
        return json_decode($response, true);
    }
}
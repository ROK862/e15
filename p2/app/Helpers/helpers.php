<?php

class AlphaVantageApiServices
{   private static $API_KEY = "DEIMSC74QZZPUZY8";
    public static function request ($symbol, $date="now") 
    {   
        $key = AlphaVantageApiServices::$API_KEY;

        if ($date == "now") {
            $url = "https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol={$symbol}&apikey={$key}";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
    
            $data = json_decode($response, true);
            $latest_price = $data['Global Quote']['05. price'];

            return ["symbol" => $symbol, "price"=>$latest_price];
        } else {
            $url = "https://www.alphavantage.co/query?function=TIME_SERIES_DAILY_ADJUSTED&symbol={$symbol}&apikey={$key}&outputsize=full";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($response, true);
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

    }

    public static function enumerate_market_openings($symbol)
    {
        $key = AlphaVantageApiServices::$API_KEY;

        $url = "https://www.alphavantage.co/query?function=TIME_SERIES_DAILY_ADJUSTED&symbol={$symbol}&apikey={$key}&outputsize=full";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);
        $date_data = $data['Time Series (Daily)'];

        return array_keys($date_data);
    }
}
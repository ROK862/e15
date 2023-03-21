# Project 2

- By: Robbins Kariseb
- URL: <http://e15p2.appsuits.org/>

## Outside resources

- [AlphaVantageApiServices Class](https://www.alphavantage.co/) references external API's for stock price lookups.
- [External Image Referenced](https://www.indiamart.com/proddetail/jackpot-tips-stocks-and-mcx-21866852073.html)

## Notes for instructor

### Structure:

- There is a helper provider which I created using the `php artisan make:provider UtilityServiceProvider` command. It can be found in `p2\app\Helpers\helpers.php` as per the referenced in `p2\config\app.php` 
```php 
'providers' => [ App\Providers\UtilityServiceProvider::class,]
``` 
- This providor contains a class named `AlphaVantageApiServices` which handles all external API calls for financial data.

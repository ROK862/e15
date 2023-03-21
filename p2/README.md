# Project 2

-   By: Robbins Kariseb
-   URL: <http://e15p2.appsuits.org/>

## Outside resources

-   [app/Helpers/ApiProvider Class](https://www.alphavantage.co/) references external API's for stock price lookups.
-   [External Image Referenced](https://www.indiamart.com/proddetail/jackpot-tips-stocks-and-mcx-21866852073.html)

## Notes for instructor

-   It is important to note that the external API service provider for Stock Data [Alpha Vantage](https://www.alphavantage.co/) limits the number of calls per minute to 5. Each post request on the form makes two calls to the Alpha Vantage servers. Hence, you need to test only two times per minute. There is an exception generated, but the try catch block will be triggered.

### Structure:

-   I used a provider and controller for most of the heavy lifting. That is, one provider and one controllers in total. `[StockController.php, ApiProvider.php]`. These two files help clean the code up in `Routes/web.php`.

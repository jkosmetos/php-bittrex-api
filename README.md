# php-bittrex-api
A PHP implementation of the Bittrex API

### Requirements
- php: ^5.6 || ^7.0
- paragonie/random_compat: >=2
- guzzlehttp/guzzle: ^6.3

### Installation
Using Composer
```
composer require jkosmetos/php-bittrex-api
```
#### Examples
The API `KEY` and `SECRET` can be obtained via your Bittrex profile, under **Settings > Manage API Keys**. For all available methods, consult the [API documentation](https://support.bittrex.com/hc/en-us/articles/115003723911-Developer-s-Guide-API#apireference)

#### Public Methods
```php
$client = new Client();
$currencies = $client->getCurrencies();

var_dump($currencies);
```
#### Account Methods
```php
$client = new Client('KEY', 'SECRET'); 
$balances = $client->getBalances();

var_dump($balances);
```
#### Market Methods
```php
$client = new Client('KEY', 'SECRET'); 
$orders = $client->getOpenOrders(); // Optionally add a market ie: 'ETH-XRP'

var_dump($orders);
```
### Coming soon
 - More examples
 - Unit tests
 - Better documentation

## Authors

* **John Kosmetos** - [jkosmetos](https://github.com/jkosmetos)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

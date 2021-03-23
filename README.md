# Pin Payments API library.

This library enables the integration of the [Pin Payments API](https://pinpayments.com/developers/api-reference) with any PHP application.

## Requirements

- PHP 7.3 or above
- Composer

## Installation

Clone this repo:
```
git clone https://github.com/proteo/pin-php.git
```

Install composer dependencies:
```
cd pin-php
composer install
```

## Supported API endpoints

- **Cards**
    - POST /cards
- **Charges**
    - POST /charges
    - PUT /charges/`charge-token`/void
    - PUT /charges/`charge-token`/capture
    - GET /charges
    - GET /charges/`charge-token`
- **Customers**
    - POST /customers
    - GET /customers
    - GET /customers/`customer-token`
    - PUT /customers/`customer-token`
    - DELETE /customers/`customer-token`
- **Plans**
    - POST /plans
    - GET /plans/
    - GET /plans/`plan-token`
    - PUT /plans/`plan-token`
    - DELETE /plans/`plan-token`
- **Refunds**
    - POST /charges/`charge-token`/refunds
- **Subscriptions**
    - POST /subscriptions
    - GET /subscriptions
    - GET /subscriptions/`sub-token`
    - PUT /subscriptions/`sub-token`
    - DELETE /subscriptions/`sub-token`
    - PUT /subscriptions/`sub-token`/reactivate
    - GET /subscriptions/`sub-token`/ledger
- **Webhook Endpoints**
    - POST /webhook_endpoints
    - GET /webhook_endpoints
    - GET /webhook_endpoints/`webhook-endpoint-token`
    - DELETE /webhook_endpoints/`webhook-endpoint-token`

## How to use

Here's a brief example to get you started:

```php
<?php

use GuzzleHttp\Exception\RequestException;
use Pin\Configuration;
use Pin\Handler;

// Set your API settings.
$secret_key = 'ABCDEFGHIJKLMNOPQRSTUV123';
$public_key = 'ABCDEFGHIJKLMNOPQRSTUV456';
$environment = 'test'; /* or 'live' */

// Initialize a configuration object.
$config = new Configuration(
  $secret_key,
  $public_key,
  $environment,
);

// Instantiate a handler with the configuration object. This is basically
// a helper that configures the request with the necessary bits before it
// can be submitted.
$handler = new Handler($config);

// You can create a request by passing a FQN class name and options as arguments
// (check the API reference to learn about options for each specific endpoint):
$handler->createRequest(Pin\Card\Create::class, [
    'number' => '4200000000000000',
    'expiry_month' => '12',
    'expiry_year' => '2023',
    'cvc' => '123',
    'name' => 'Roland Robot',
    'address_line1' => '42 Sevenoaks St',
    'address_line2' => '',
    'address_city' => 'Lathlain',
    'address_postcode' => '6454',
    'address_state' => 'WA',
    'address_country' => 'Australia',
]);

// Finally, submit the request and grab its response. This should always be
// done inside a try block, as any error during the execution of the request
// will throw an exception:
try {
    $response = $handler->submit();
} catch (RequestException $e) {
    echo $e->getMessage();
}

echo '<pre>' . print_r($response, TRUE) . '</pre>';
```

If for some reason you need or prefer to instantiate the request separately (for example, if you plan to reuse the `$handler` instance), you can do it using the `$handler->setRequest()` method:

```php
<?php

// Instantiate a request separately...
$request = new Pin\Card\Create([
    'number' => '4200000000000000',
    'expiry_month' => '12',
    'expiry_year' => '2023',
    'cvc' => '123',
    'name' => 'Roland Robot',
    'address_line1' => '42 Sevenoaks St',
    'address_line2' => '',
    'address_city' => 'Lathlain',
    'address_postcode' => '6454',
    'address_state' => 'WA',
    'address_country' => 'Australia',
]);

// ...and set it.
$handler->setRequest($request);

// Submit the request and grab its response.
try {
    $response = $handler->submit();
} catch (RequestException $e) {
    echo $e->getMessage();
}
```

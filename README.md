# thanks-io-php

A simple PHP SDK for the Thanks.io API

## Installation

This library requires PHP 7.1 and later

The recommended way to install thanks-io-php is through [Composer](https://getcomposer.org):

This library is intended to speed up development time but is not a shortcut to reading the Thanks.io API documentation. Many endpoints require specific and required fields for successful operation. Always read the documentation before using an endpoint.

Important: This library DOES NOT validate address data.

```sh
composer require mckltech/thanks-io-php
```

## Clients - API Key 

Initialize your client using your access token:

```php
use ThanksIO\ThanksIOClient;

$client = new ThanksIOClient('API_ACCESS_KEY_XXXX');
```

> - You can find your API Key by following the Thanks.io API documentation: https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest


## Support, Issues & Bugs

This library is unofficial and is not endorsed or supported by Thanks.io

For bugs and issues, open an issue in this repo and feel free to submit a PR. Any issues that do not contain full logs or explainations will be closed. We need you to help us help you!

## API Versions

This library is intended to work with Version 2.0 of the Thanks.io Public API

## Examples & Common Tasks

```php
/* List Mailing Lists */
$client->mailingLists->list();

/* Get Receipent by ID */
$client->recipients->get(1234);

/** Send a postcard */

$message = "Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.";

// You can alternatively provide the 'message_template' parameter 

$payload = [
    'handwriting_style' => 2,
    'image_template' => 4,
    'message' => $message
];
        
$recipient = [
    'name' => 'John Smith'
    'address' => '123 Main St'
    'city' => 'Manhattan'
    'province' => 'NY'
    'postal_code' => '55555',
    'country' => 'US'
 ];
        
$payload['recipients'][] = $recipient;
        
$client->send->postcard($payload);

```

## Supported Endpoints

All endpoints follow a similar mechanism to the examples show above. Again, please ensure you read the Thanks.io API documentation prior to use as there are numerous required fields for most operations.

- Send
- Preview
- Envelopes
- Sub-Account
- Mailing Lists
- Image Templates
- Message Templates
- Handwriting Styles
- Recipients
- Orders

## Exceptions

Exceptions are handled by HTTPlug. Every exception thrown implements `Http\Client\Exception`. See the [http client exceptions](http://docs.php-http.org/en/latest/httplug/exceptions.html) and the [client and server errors](http://docs.php-http.org/en/latest/plugins/error.html). If you want to catch errors you can wrap your API call into a try/catch block:

```php
try {
    $mailingLists = $client->mailingLists->list();
} catch(Http\Client\Exception $e) {
    if ($e->getCode() == '404') {
        // Handle 404 error
        return;
    } else {
        throw $e;
    }
}
```

## Credit

The layout and methodology used in this library is courtesy of https://github.com/intercom/intercom-php



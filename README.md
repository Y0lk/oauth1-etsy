# Etsy Provider for OAuth 1.0 Client

This package provides Etsy API OAuth 1.0 support for the PHP League's [OAuth 1.0 Client](https://github.com/thephpleague/oauth1-client).

## Installation

```
composer require y0lk/oauth1-etsy
```

## Usage

Usage is the same as The League's OAuth client, using `Y0lk\OAuth1\Client\Server\Etsy` as the provider.

```php
$server = new Y0lk\OAuth1\Client\Server\Etsy([
    'identifier'   => 'your-client-id',
    'secret'       => 'your-client-secret',
    'callback_uri' => 'http://callback.url/callback',
]);
```
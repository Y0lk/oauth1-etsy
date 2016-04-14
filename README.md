# Etsy Provider for OAuth 1.0 Client

This package provides Etsy API OAuth 1.0 support for the PHP League's [OAuth 1.0 Client](https://github.com/thephpleague/oauth1-client).

## Installation

Via Composer

```shell
$ composer require y0lk/oauth1-etsy
```

## Usage

Usage is the same as The League's OAuth client, using `Y0lk\OAuth1\Client\Server\Etsy` as the provider.

```php
$server = new Y0lk\OAuth1\Client\Server\Etsy([
    'identifier'   	=> 'your-client-id',
    'secret'       	=> 'your-client-secret',
    'scope'			=> '', //See Etsy documentation for the full list of permission scopes
    'callback_uri' 	=> 'http://callback.url/callback'
]);
```

### Permission Scopes
See the Etsy documentation for [Permission Scopes](https://www.etsy.com/developers/documentation/getting_started/oauth#section_permission_scopes)


## License

The MIT License (MIT). Please see [License File](https://github.com/thephpleague/oauth1-client/blob/master/LICENSE) for more information.
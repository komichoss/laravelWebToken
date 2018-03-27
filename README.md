# laravelWebToken

### Install via composer
Add orm to composer.json configuration file.

```
$ composer require komicho/laravelwebtoken
```

### add to file config/app.php
```php
'providers' => [
    ...
    komicho\Support\ServiceProvider::class,
],
```

### publish 
```
$ php artisan vendor:publish
```
OR
```
$ php artisan vendor:publish --provider="komicho\Support\ServiceProvider"
```
you can use migrate
```
$ php artisan migrate:fresh
```

### use
```php
use komicho\laravelWebToken;
```
## functions
#### add
```php
laravelWebToken::add('key', 'value');
```
#### get
```php
laravelWebToken::get('key');
```
#### get Token
```php
laravelWebToken::getToken();
```
#### exists
```php
laravelWebToken::exists('key');
```
#### delete
```php
laravelWebToken::delete('key');
```
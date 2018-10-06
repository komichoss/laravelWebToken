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

### How work
Send the `userToken` header in any request you want to use in `web token`
#### Example
```javascript
$.ajaxSetup({
    headers: {'userToken': '<userToken>'}
});
```

### use
```php
use komicho\laravelWebToken;
```
## functions
#### create
```php
function(laravelWebToken $token)
{
    $userToken = $token->create();
}
```
#### add
```php
function(Request $request, laravelWebToken $token)
{
    return $token->id($request)->add('user_id', 1);
}
```
#### get
```php
function(Request $request, laravelWebToken $token)
{
    return $token->id($request)->get('user_id');
}
```
#### exists
```php
function(Request $request, laravelWebToken $token)
{
    return $token->id($request)->exists('user_id');
}
```
#### delete
```php
function(Request $request, laravelWebToken $token)
{
    return $token->id($request)->delete('user_id');
}
```
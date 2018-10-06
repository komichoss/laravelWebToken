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
### Migrate
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
    return $token->create();
}
```
response :-
```
9ddcbe82eed026ce8591596703791054
```
This is a token value

#### add
```php
function(Request $request, laravelWebToken $token)
{
    return $token->id($request)->add('user_id', 1);
}
```
response :-
```json
{
    "token": "<userToken>",
    "key": "user_id",
    "value": 1
}
```

#### get
```php
function(Request $request, laravelWebToken $token)
{
    return $token->id($request)->get('user_id');
}
```
response :-
```
1
```
this token value

#### exists
```php
function(Request $request, laravelWebToken $token)
{
    return $token->id($request)->exists('user_id');
}
```
response :-
```
true
```
This response `true` or `false`

#### delete
```php
function(Request $request, laravelWebToken $token)
{
    return $token->id($request)->delete('user_id');
}
```
Nothing in response
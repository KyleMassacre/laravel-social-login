# Laravel Social Login

This is a basic plugin to handle your social login and registration requests.

To install, download through composer

`$ composer require kylemass/sociallogin`

Or by adding:
```javascript
{
	"require": {
		"kylemass/sociallogin": "~1.0"
	}
}
```
Once you have added the package, add the Service Provider to your list of service providers:
```php
'providers' => [
    ...
    KyleMass\SocialLogin\SocialLoginServiceProvider::class,
],
```
Next you have to publish the package:

`$ php artisan vendor:publish --provider="KyleMass\SocialLogin\SocialLoginServiceProvider"
`

The package comes with a migration file, so last but not least run:

`$ php artisan migrate`

That is it, your routes will automatically be generated which look like:
```php
Route::get('auth/social/{provider}', 'KyleMass\SocialLogin\SocialLoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'KyleMass\SocialLogin\SocialLoginController@handleProviderCallback');
```

All you will have to do is create the links the social providers you wish to use for example:

```html
<a href="{{ url('auth/social/github') }}">Login with Github</a>
```

And for your callback URL will be http://www.yourdomain.tld/auth/github/callback

This package requires laravel/socailite so you can find the documentation on how to set that up at the [Laravel website](http://laravel.com/docs/authentication#social-authentication).
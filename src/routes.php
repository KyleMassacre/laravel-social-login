<?php

Route::get('auth/social/{provider}', 'KyleMass\SocialLogin\SocialLoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'KyleMass\SocialLogin\SocialLoginController@handleProviderCallback');
<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 1/1/16
 * Time: 5:22 AM
 */

namespace KyleMass\SocialLogin;

use App\User;
use KyleMass\SocialLogin\Models\SocialProviders;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class SocialLoginController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return \Redirect::to('auth/social/'.$provider);
        }

        $authUser = $this->findOrCreateUser($user, $provider);

        \Auth::login($authUser, true);

        return \Redirect::to('dashboard');
    }

    private function findOrCreateUser($user, $provider)
    {
        if ($authUser = SocialProviders::where('providerId', $user->id)->where('provider',$provider)->first()) {
            return $authUser->user;
        }

        $newUser = new User([
            'name' => isset($user->name) ? $user->name : $user->nickname,
            'email' => $user->email,
        ]);
        $newUser->save();
        $socailProvider = new SocialProviders([
            'user_id' => $newUser->id,
            'provider' => $provider,
            'providerId' => $user->id,
            'avatar' => $user->avatar
        ]);
        $socailProvider->save();

//        $newUser->name = isset($user->name) ? $user->name : $user->nickname;
//        $newUser->email = $user->email;
//        $newUser->application_id = $user->id;
//        $newUser->avatar = $user->avatar;
//        $newUser->token = $user->token;
//        $newUser->app_type = $provider;
//        $newUser->save();
        return $newUser;

    }
}
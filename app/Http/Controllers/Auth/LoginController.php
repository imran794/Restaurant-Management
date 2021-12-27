<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handelProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $exisituser = User::whereEmail($user->getEmail())->first();

        if ($exisituser) {
            Auth::login($exisituser);
        }else{
            $newuser = User::create([
                'role_id'   => Role::where('slug','user')->first()->id,
                'name'      => $user->getName(),
                'email'     => $user->getEmail(),
                'provider_id'   => $user->getId(),
                'status'    => true
            ]);
        }
         Auth::login($newuser);

        return redirect($this->redirectPath());
    }
}

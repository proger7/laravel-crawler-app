<?php

namespace App\Http\Controllers\Web;

use Auth;
use Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\Controller;


class AuthenticationController extends Controller
{

	public function getSocialRedirect($account)
	{
		try {
			return Socialite::with($account)->redirect();
		} catch (\InvalidArgumentException $e) {
			return redirect('/login');
		}
	}

	public function getSocialUser($socialUser, $account)
	{
		$newUser = new User;
		$newUser->name = $socialUser->getName();
		$newUser->email = $socialUser->getEmail() == '' ? '' : $socialUser->getEmail();
		$newUser->avatar = $socialUser->getAvatar();
		$newUser->password = '';
		$newUser->provider = $account;
		$newUser->provider_id = $socialUser->getId();
		$newUser->save();
		$user = $newUser;
	}

	public function getSocialCallback($account)
	{
		$socialUser = Socialite::with($account)->user();
		$user = User::identifier($socialUser->id)
					->accountName($account)
					->first();

		if($user == null) 
		{
			$this->getSocialUser($socialUser, $account);
		}

		Auth::login($user);
		return redirect('/');
	}

}
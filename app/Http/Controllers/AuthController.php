<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
	public function register()
	{
		$token = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/authentication/token/new')
			->json()['request_token'];

		return redirect('https://www.themoviedb.org/authenticate/' . $token . '?redirect_to=http://linton.test/login')->with('success', 'Registration successfully!');
	}

	public function login()
	{
		return view('auth.index');
	}

	public function authenticate(Request $request)
	{
		$data = [
			'username' => $request->input('username'),
			'password' => $request->input('password'),
			'request_token' => Http::withToken(config('services.tmdb.token'))
				->get('https://api.themoviedb.org/3/authentication/token/new')
				->json()['request_token']
		];

		$session = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/authentication/token/validate_with_login?username=' . $data['username'] . '&password=' . $data['password'] . '&request_token=' . $data['request_token'])
			->json();

		if ($session['success'] === true) {
			return redirect('/')->with('success', 'Welcome back' . $data['username'] . '!');
		} else {
			return redirect('http://linton.test/login')->with('fail', 'Username or password wrong!');
		}
	}
}

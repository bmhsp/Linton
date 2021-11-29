<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
	public function register()
	{
		return view('auth.register');
	}

	public function store(Request $request)
	{
		$username = $request->input('username');
		$password = $request->input('password');

		$token = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/authentication/token/new')
			->json();

		return redirect('https://www.themoviedb.org/authenticate/' . $token . '/allow?redirect_to=http://linton.test/login/approved');
	}

	public function login()
	{
		return view('auth.login');
	}
}

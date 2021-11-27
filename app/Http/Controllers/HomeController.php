<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\HomeViewModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
	public function index()
	{
		$movies = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/trending/movie/day')
			->json()['results'];

		$tv = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/trending/tv/day')
			->json()['results'];

		$persons = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/trending/person/day')
			->json()['results'];

		$viewModels = new HomeViewModel($movies, $tv, $persons);

		return view('home.index', $viewModels);
	}
}

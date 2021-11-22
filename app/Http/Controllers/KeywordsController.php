<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\MovieKeywordViewModel;
use App\ViewModels\TvKeywordViewModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class KeywordsController extends Controller
{
	public function movie($id)
	{
		$popular = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/discover/movie?with_keywords=' . $id . '&sort_by=popularity.desc')
			->json()['results'];

		$topRated = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/discover/movie?with_keywords=' . $id . '&sort_by=vote_average.desc')
			->json()['results'];

		$latest = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/discover/movie?with_keywords=' . $id . '&sort_by=release_date.desc')
			->json()['results'];

		$viewModel = new MovieKeywordViewModel($popular, $topRated, $latest);

		return view('genre.movie', $viewModel);
	}

	public function tv($id)
	{
		$popular = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/discover/tv?with_keywords=' . $id . '&sort_by=popularity.desc')
			->json()['results'];

		$topRated = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/discover/tv?with_keywords=' . $id . '&sort_by=vote_average.desc')
			->json()['results'];

		$latest = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/discover/tv?with_keywords=' . $id . '&sort_by=first_air_date.desc')
			->json()['results'];

		$viewModel = new TvKeywordViewModel($popular, $topRated, $latest);

		return view('genre.tv', $viewModel);
	}
}

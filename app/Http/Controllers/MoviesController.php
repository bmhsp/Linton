<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\MovieViewModel;
use App\ViewModels\MoviesViewModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
	public function index()
	{
		$nowPlaying = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/movie/now_playing')
			->json()['results'];

		$popularMovies = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/movie/popular')
			->json()['results'];

		$topRated = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/movie/top_rated')
			->json()['results'];

		$upcoming = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/movie/upcoming')
			->json()['results'];

		$viewModel = new MoviesViewModel(
			$nowPlaying,
			$popularMovies,
			$topRated,
			$upcoming,
		);

		return view('movies.index', $viewModel);
	}

	public function show($id)
  {
    $movie = Http::withToken(config('services.tmdb.token'))
      ->get('https://api.themoviedb.org/3/movie/' . $id . '?append_to_response=credits,videos,images')
      ->json();

    $recommendMovie = Http::withToken(config('services.tmdb.token'))
      ->get('https://api.themoviedb.org/3/movie/' . $id . '/recommendations')
      ->json()['results'];

    $keywords = Http::withToken(config('services.tmdb.token'))
      ->get('https://api.themoviedb.org/3/movie/' . $id . '/keywords')
      ->json()['keywords'];

    $viewModel = new MovieViewModel($movie, $recommendMovie, $keywords);

    return view('movies.show', $viewModel);
  }
}

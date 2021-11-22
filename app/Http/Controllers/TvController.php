<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\TvViewModel;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\TvShowViewModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$airingToday = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/tv/airing_today')
			->json()['results'];

		$onTheAir = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/tv/on_the_air')
			->json()['results'];

		$popularTv = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/tv/popular')
			->json()['results'];

		$topRated = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/tv/top_rated')
			->json()['results'];

		$genres = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/genre/tv/list')
			->json()['genres'];

		$viewModel = new TvViewModel(
			$airingToday,
			$onTheAir,
			$popularTv,
			$topRated,
			$genres
		);

		return view('tv.index', $viewModel);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */

	public function show($id)
	{
		$tvshow = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/tv/' . $id . '?append_to_response=credits,videos,images')
			->json();

		$recomendTv = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/tv/' . $id . '/recommendations')
			->json()['results'];

		$keywords = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/tv/' . $id . '/keywords')
			->json()['results'];

		$viewModel = new TvShowViewModel($tvshow, $recomendTv, $keywords);

		return view('tv.show', $viewModel);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}

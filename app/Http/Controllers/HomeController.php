<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ViewModels\HomeViewModel;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
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
		//
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

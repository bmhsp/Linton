<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\MoviesViewModel;
use App\Http\Controllers\Controller;
use App\ViewModels\MovieViewModel;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
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

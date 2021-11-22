<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\SeasonViewModel;
use App\Http\Controllers\Controller;
use App\ViewModels\EpisodeViewModel;
use App\ViewModels\SeasonsViewModel;
use Illuminate\Support\Facades\Http;

class SeasonsController extends Controller
{
	public function index($id)
	{
		$seasons = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/tv/' . $id)
			->json();

		$viewModel = new SeasonsViewModel($seasons);

		return view('seasons.index', $viewModel);
	}

	public function show($id, $season)
	{
		$season = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/tv/' . $id . '/season/' . $season)
			->json();

		$tv = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/tv/' . $id)
			->json();

		$viewModel = new SeasonViewModel($season, $tv);

		return view('seasons.show', $viewModel);
	}
}

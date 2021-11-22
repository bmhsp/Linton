<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\ViewModels\EpisodeViewModel;
use Illuminate\Support\Facades\Http;

class EpisodeController extends Controller
{
	public function index($id, $season, $episode)
	{
		$episode = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/tv/' . $id . '/season/' . $season . '/episode/' . $episode . '?append_to_response=credits,videos,images')
			->json();

		$season = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/tv/' . $id . '/season/' . $season)
			->json();

		$tv = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/tv/' . $id)
			->json();

		$viewModel = new EpisodeViewModel($episode, $season, $tv);

		return view('episode.index', $viewModel);
	}
}

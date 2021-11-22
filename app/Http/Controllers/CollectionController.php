<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\ViewModels\CollectionViewModel;

class CollectionController extends Controller
{
	public function index($id)
	{
		$collection = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/collection/' . $id)
			->json();

		$viewModel = new CollectionViewModel($collection);

		return view('collection.index', $viewModel);
	}
}

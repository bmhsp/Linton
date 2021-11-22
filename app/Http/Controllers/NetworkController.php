<?php

namespace App\Http\Controllers;

use App\ViewModels\NetworkViewModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class NetworkController extends Controller
{
  public function index($id)
  {
    $networks = Http::withToken(config('services.tmdb.token'))
      ->get('https://api.themoviedb.org/3/network/' . $id)
      ->json();

    $tv = Http::withToken(config('services.tmdb.token'))
      ->get('https://api.themoviedb.org/3/discover/tv?with_networks=' . $id)
      ->json()['results'];

    $viewModel = new NetworkViewModel($networks, $tv);

    return view('network.index', $viewModel);
  }
}

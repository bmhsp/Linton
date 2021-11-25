<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
  public $nowPlaying;
  public $popularMovies;
  public $topRated;
  public $upcoming;

  public function __construct($nowPlaying, $popularMovies, $topRated, $upcoming)
  {
    $this->nowPlaying = $nowPlaying;
    $this->popularMovies = $popularMovies;
    $this->topRated = $topRated;
    $this->upcoming = $upcoming;
  }

  public function nowPlaying()
  {
    return $this->formatMovies($this->nowPlaying);
  }

  public function popularMovies()
  {
    return $this->formatMovies($this->popularMovies);
  }

  public function topRated()
  {
    return $this->formatMovies($this->topRated);
  }

  public function upcoming()
  {
    return $this->formatMovies($this->upcoming);
  }

  private function formatMovies($movies)
  {
    return collect($movies)->map(function ($movie) {
      return collect($movie)->merge([
        'poster_path' => $movie['poster_path']
          ? 'https://image.tmdb.org/t/p/w500' . $movie['poster_path']
          : "https://via.placeholder.com/500x750?text=ERROR",
        'link' => $movie['id'] . '/' . Str::slug($movie['title']),
        'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
        'vote_average' => Str::limit($movie['vote_average'], 3, ''),
      ])->only([
        'poster_path', 'id', 'title', 'vote_average', 'release_date', 'link'
      ]);
    });
  }
}

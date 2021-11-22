<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
  public $nowPlaying;
  public $popularMovies;
  public $topRated;
  public $upcoming;
  public $genres;

  public function __construct($nowPlaying, $popularMovies, $topRated, $upcoming, $genres)
  {
    $this->nowPlaying = $nowPlaying;
    $this->popularMovies = $popularMovies;
    $this->topRated = $topRated;
    $this->upcoming = $upcoming;
    $this->genres = $genres;
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

  public function genres()
  {
    return collect($this->genres)->mapWithKeys(function ($genre) {
      return [$genre['id'] => $genre['name']];
    });
  }

  private function formatMovies($movies)
  {
    return collect($movies)->map(function ($movie) {
      return collect($movie)->merge([
        'poster_path' => $movie['poster_path']
          ? 'https://image.tmdb.org/t/p/w500' . $movie['poster_path']
          : "https://via.placeholder.com/500x750?text=ERROR",
        'release_date' => \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y'),
      ])->only([
        'poster_path', 'id', 'title', 'vote_average', 'release_date'
      ]);
    });
  }
}

<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
  public $airingToday;
  public $onTheAir;
  public $popularTv;
  public $topRated;
  public $genres;

  public function __construct($airingToday, $onTheAir, $popularTv, $topRated, $genres)
  {
    $this->airingToday = $airingToday;
    $this->onTheAir = $onTheAir;
    $this->popularTv = $popularTv;
    $this->topRated = $topRated;
    $this->genres = $genres;
  }

  public function airingToday()
  {
    return $this->formatTv($this->airingToday);
  }

  public function onTheAir()
  {
    return $this->formatTv($this->onTheAir);
  }

  public function popularTv()
  {
    return $this->formatTv($this->popularTv);
  }

  public function topRated()
  {
    return $this->formatTv($this->topRated);
  }

  public function genres()
  {
    return collect($this->genres)->mapWithKeys(function ($genre) {
      return [$genre['id'] => $genre['name']];
    });
  }

  private function formatTv($tv)
  {
    return collect($tv)->map(function ($tvshow) {
      $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function ($value) {
        return [$value => $this->genres()->get($value)];
      })->implode(', ');

      return collect($tvshow)->merge([
        'poster_path' => $tvshow['poster_path']
          ? 'https://image.tmdb.org/t/p/w500' . $tvshow['poster_path']
          : "https://via.placeholder.com/500x750?text=ERROR",
        'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
        'link' => $tvshow['id'] . '/' . Str::slug($tvshow['name']),
        'genres' => $genresFormatted,
      ])->only([
        'poster_path', 'id', 'name', 'vote_average', 'first_air_date', 'link'
      ]);
    });
  }
}

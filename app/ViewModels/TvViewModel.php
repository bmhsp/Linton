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

  public function __construct($airingToday, $onTheAir, $popularTv, $topRated)
  {
    $this->airingToday = $airingToday;
    $this->onTheAir = $onTheAir;
    $this->popularTv = $popularTv;
    $this->topRated = $topRated;
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

  private function formatTv($tv)
  {
    return collect($tv)->map(function ($tvshow) {
      return collect($tvshow)->merge([
        'poster_path' => $tvshow['poster_path']
          ? 'https://image.tmdb.org/t/p/w500' . $tvshow['poster_path']
          : "https://via.placeholder.com/500x750?text=ERROR",
        'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
        'link' => $tvshow['id'] . '/' . Str::slug($tvshow['name']),
      ])->only([
        'poster_path', 'id', 'name', 'vote_average', 'first_air_date', 'link'
      ]);
    });
  }
}

<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class TvKeywordViewModel extends ViewModel
{
  public $popular;
  public $topRated;
  public $latest;

  public function __construct($popular, $topRated, $latest)
  {
    $this->popular = $popular;
    $this->topRated = $topRated;
    $this->latest = $latest;
  }

  public function popular()
  {
    return $this->formatCard($this->popular);
  }

  public function topRated()
  {
    return $this->formatCard($this->topRated);
  }

  public function latest()
  {
    return $this->formatCard($this->latest);
  }

  private function formatCard($cards)
  {
    return collect($cards)->map(function ($card) {
      return collect($card)->merge([
        'name' => isset($card['name']) ? $card['name'] : 'Unknown',
        'poster_path' => $card['poster_path']
          ? 'https://image.tmdb.org/t/p/w500/' . $card['poster_path']
          : "https://via.placeholder.com/500x750?text=ERROR",
        'first_air_date' => isset($card['first_air_date'])
          ? \Carbon\Carbon::parse($card['first_air_date'])->format('M d, Y')
          : 'Future',
      ])->only([
        'poster_path', 'id', 'name', 'vote_average', 'first_air_date'
      ]);
    });
  }
}

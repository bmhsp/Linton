<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MovieGenreViewModel extends ViewModel
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
        'title' => isset($card['title']) ? $card['title'] : 'Unknown',
        'poster_path' => $card['poster_path']
          ? 'https://image.tmdb.org/t/p/w500/' . $card['poster_path']
          : "https://via.placeholder.com/500x750?text=ERROR",
        'release_date' => isset($card['release_date'])
          ? \Carbon\Carbon::parse($card['release_date'])->format('M d, Y')
          : 'Future',
      ])->only([
        'poster_path', 'id', 'title', 'vote_average', 'release_date'
      ]);
    });
  }
}

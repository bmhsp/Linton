<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;

class NetworkViewModel extends ViewModel
{
  public $networks;
  public $tv;

  public function __construct($networks, $tv)
  {
    $this->networks = $networks;
    $this->tv = $tv;
  }

  public function networks()
  {
    return collect($this->networks)->merge([
      'logo_path' => 'https://image.tmdb.org/t/p/w500' . $this->networks['logo_path'],
    ]);
  }

  public function tv()
  {
    return collect($this->tv)->map(function ($tvshow) {
      return collect($tvshow)->merge([
        'poster_path' => $tvshow['poster_path']
          ? 'https://image.tmdb.org/t/p/w500' . $tvshow['poster_path']
          : "https://via.placeholder.com/500x750?text=ERROR",
        'release_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
        'link' => $tvshow['id'] . '/' . Str::slug($tvshow['name']),
      ]);
    });
  }
}

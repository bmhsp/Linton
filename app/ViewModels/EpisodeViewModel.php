<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;

class EpisodeViewModel extends ViewModel
{
  public $episode;
  public $season;
  public $tv;

  public function __construct($episode, $season, $tv)
  {
    $this->episode = $episode;
    $this->season = $season;
    $this->tv = $tv;
  }

  public function episode()
  {
    return collect($this->episode)->merge([
      'still_path' => $this->episode['still_path']
        ? 'https://image.tmdb.org/t/p/w500' . $this->episode['still_path']
        : 'https://via.placeholder.com/750x500?text=ERROR',
      'air_date' => Carbon::parse($this->episode['air_date'])->format('d F Y'),
      'overview' => $this->episode['overview'] ? $this->episode['overview'] : "We don't have enough data for this episode",
    ]);
  }

  public function getCast()
  {
    $casts = collect($this->episode['credits'])->get('cast');

    return collect($casts)->map(function ($cast) {
      return collect($cast)->merge([
        'profile_path' => $cast['profile_path']
          ? 'https://image.tmdb.org/t/p/w235_and_h235_face/' . $cast['profile_path']
          : 'https://ui-avatars.com/api/?size=235&name=' . $cast['name'],
        'slug' => $cast['id'] . '/' . Str::slug($cast['name']),
      ]);
    });
  }

  public function getGuest()
  {
    $guestStar = collect($this->episode)->get('guest_stars');

    return collect($guestStar)->map(function ($guest) {
      return collect($guest)->merge([
        'profile_path' => $guest['profile_path']
          ? 'https://image.tmdb.org/t/p/w235_and_h235_face/' . $guest['profile_path']
          : 'https://ui-avatars.com/api/?size=235&name=' . $guest['name'],
        'slug' => $guest['id'] . '/' . Str::slug($guest['name']),
      ]);
    });
  }

  public function getCrew()
  {
    $crews = collect($this->episode['credits'])->get('crew');

    return collect($crews)->map(function ($crew) {
      return collect($crew)->merge([
        'profile_path' => $crew['profile_path']
          ? 'https://image.tmdb.org/t/p/w235_and_h235_face/' . $crew['profile_path']
          : 'https://ui-avatars.com/api/?size=235&name=' . $crew['name'],
        'slug' => $crew['id'] . '/' . Str::slug($crew['name']),
      ]);
    });
  }

  public function getImage()
  {
    $images = collect($this->episode['images'])->get('stills');

    return collect($images)->map(function ($image) {
      return collect($image)->merge([
        'file_path' => $image['file_path']
          ? 'https://image.tmdb.org/t/p/original' . $image['file_path']
          : 'https://via.placeholder.com/750x500?ERROR',
      ]);
    });
  }

  public function getSeason()
  {
    return collect($this->season)->merge([
      'poster_path' => $this->season['poster_path']
        ? 'https://image.tmdb.org/t/p/w500' . $this->season['poster_path']
        : 'https://via.placeholder.com/500x750?ERROR',
      'season_link' =>  '/season/' . $this->season['season_number'],
      'year_date' => Carbon::parse($this->season['air_date'])->format('Y'),
    ]);
  }

  public function getTv()
  {
    return collect($this->tv)->only([
      'id', 'original_name'
    ]);
  }
}

<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
  public $tvshow;
  public $recommendTv;
  public $keywords;

  public function __construct($tvshow, $recommendTv, $keywords)
  {
    $this->tvshow = $tvshow;
    $this->recommendTv = $recommendTv;
    $this->keywords = $keywords;
  }

  public function tvshow()
  {
    return collect($this->tvshow)->merge([
      'poster_path' => $this->tvshow['poster_path']
        ? 'https://image.tmdb.org/t/p/w500' . $this->tvshow['poster_path']
        : "https://via.placeholder.com/500x750?text=ERROR",
      'backdrop_path' => $this->tvshow['backdrop_path']
        ? 'https://image.tmdb.org/t/p/original' . $this->tvshow['backdrop_path']
        : 'https://via.placeholder.com/750x500?text=ERROR',
      'production_countries' => $this->tvshow['production_countries']
        ? $this->tvshow['production_countries'][0]['name']
        : 'Unknown',
      'first_air_date' => Carbon::parse($this->tvshow['first_air_date'])->format('d F Y'),
      'link' =>  $this->tvshow['id'] . '/' . Str::slug($this->tvshow['name']),
      'created_by' => $this->tvshow['created_by'] ? $this->tvshow['created_by'][0]['name'] : null,
      'episode_run_time' => $this->tvshow['episode_run_time'] ? $this->tvshow['episode_run_time'][0] . 'm' : '0m',
      'vote_average' => Str::limit($this->tvshow['vote_average'], 3, '')
    ])->only([
      'id', 'name', 'poster_path', 'backdrop_path', 'vote_average', 'type', 'first_air_date', 'videos', 'episode_run_time', 'genres', 'credits', 'seasons', 'networks', 'images', 'overview', 'status', 'created_by', 'production_countries', 'link', 'original_name'
    ]);
  }

  public function getGenre()
  {
    $genres = collect($this->tvshow['genres']);

    return collect($genres)->map(function ($genre) {
      return collect($genre)->merge([
        'link' => $genre['id'] . '/' . Str::slug($genre['name']),
      ]);
    });
  }

  public function getVideo()
  {
    $videos = collect($this->tvshow['videos'])->get('results');

    return collect($videos)->take(5)->map(function ($video) {
      return collect($video)->merge([
        'thumbnail' => 'http://i3.ytimg.com/vi/' . $video['key'] . '/hqdefault.jpg'
      ])->only([
        'id', 'key', 'name', 'thumbnail', 'type'
      ]);
    });
  }

  public function getCast()
  {
    $casts = collect($this->tvshow['credits'])->get('cast');

    return collect($casts)->map(function ($cast) {
      return collect($cast)->merge([
        'link' => $cast['id'] . '/' . Str::slug($cast['name']),
        'profile_path' => $cast['profile_path']
          ? 'https://image.tmdb.org/t/p/w300' . $cast['profile_path']
          : 'https://via.placeholder.com/300x450?text=ERROR'
      ]);
    });
  }

  public function getSeason()
  {
    $seasons = collect($this->tvshow['seasons']);

    return collect($seasons)->map(function ($season) {
      return collect($season)->merge([
        'season_poster' => $season['poster_path']
          ? 'https://image.tmdb.org/t/p/w500' . $season['poster_path']
          : 'https://via.placeholder.com/500x750?text=ERROR',
        'year_air_date' => Carbon::parse($season['air_date'])->format('Y'),
        'air_date' => $season['air_date'] != null
          ? ' aired on ' . Carbon::parse($season['air_date'])->format('d F Y')
          : ' will be aired soon',
        'season_link' => '/season/' . $season['season_number']
      ]);
    });
  }

  public function getNetwork()
  {
    $networks = collect($this->tvshow['networks']);

    return collect($networks)->map(function ($network) {
      return collect($network)->merge([
        'logo_path' => $network['logo_path']
          ? 'https://image.tmdb.org/t/p/w300' . $network['logo_path']
          : 'https://via.placeholder.com/150?text=ERROR',
        'link' => $network['id'] . '/' . Str::slug($network['name']),
      ]);
    });
  }

  public function getImage()
  {
    $images = collect($this->tvshow['images'])->get('backdrops');

    return collect($images)->map(function ($image) {
      return collect($image)->merge([
        'file_path' => $image['file_path']
          ? 'https://image.tmdb.org/t/p/original' . $image['file_path']
          : 'https://via.placeholder.com/750x500?text=ERROR'
      ]);
    });
  }

  public function recommendTv()
  {
    return collect($this->recommendTv)->map(function ($tvshow) {
      return collect($tvshow)->merge([
        'poster_path' => $tvshow['poster_path']
          ? 'https://image.tmdb.org/t/p/w500/' . $tvshow['poster_path']
          : "https://via.placeholder.com/500x750?text=ERROR",
        'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
        'link' => $tvshow['id'] . '/' . Str::slug($tvshow['name']),
        'vote_average' => Str::limit($tvshow['vote_average'], 3, '')
      ])->only([
        'poster_path', 'id', 'name', 'vote_average', 'overview', 'first_air_date', 'link'
      ]);
    });
  }

  public function keywords()
  {
    return collect($this->keywords)->map(function ($keyword) {
      return collect($keyword)->merge([
        'link' => $keyword['id'] . '/' . Str::slug($keyword['name']),
      ]);
    });
  }
}

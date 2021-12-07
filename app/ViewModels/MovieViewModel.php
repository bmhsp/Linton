<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
	public $movie;
	public $recommendMovie;
	public $keywords;

	public function __construct($movie, $recommendMovie, $keywords)
	{
		$this->movie = $movie;
		$this->recommendMovie = $recommendMovie;
		$this->keywords = $keywords;
	}

	public function movie()
	{
		return collect($this->movie)->merge([
			'poster_path' => $this->movie['poster_path']
				? 'https://image.tmdb.org/t/p/w500' . $this->movie['poster_path']
				: 'https://via.placeholder.com/500x750?text=ERROR',
			'backdrop_path' => $this->movie['backdrop_path']
				? 'https://image.tmdb.org/t/p/w500' . $this->movie['backdrop_path']
				: 'https://via.placeholder.com/750x500?text=ERROR',
			'overview' => $this->movie['overview'] ? $this->movie['overview'] : "Sorry we don't have enough data for this movie.",
			'budget' => $this->movie['budget']
				? '$' . number_format($this->movie['budget'])
				: 'Unknown',
			'revenue' => $this->movie['revenue']
				? '$' . number_format($this->movie['revenue'])
				: 'Unknown',
			'release_date' => Carbon::parse($this->movie['release_date'])->format('d F Y'),
			'vote_average' => Str::limit($this->movie['vote_average'], 3, '')
		])->only([
			'id', 'title', 'original_title', 'backdrop_path', 'poster_path', 'release_date', 'overview', 'videos', 'budget', 'revenue', 'genres', 'vote_average', 'status', 'credits', 'crew', 'homepage'
		]);
	}

	public function getGenre()
	{
		$genres = collect($this->movie['genres']);

		return collect($genres)->map(function ($genre) {
			return collect($genre)->merge([
				'link' => $genre['id'] . '/' . Str::slug($genre['name']),
			]);
		});
	}

	public function getVideo()
	{
		$videos = collect($this->movie['videos'])->get('results');

		return collect($videos)->where('type', 'Teaser')->take(5)->map(function ($video) {
			return collect($video)->merge([
				'thumbnail' => 'http://i3.ytimg.com/vi/' . $video['key'] . '/hqdefault.jpg'
			])->only([
				'id', 'key', 'name', 'thumbnail', 'type'
			]);
		});
	}

	public function getCrew()
	{
		$crews = collect($this->movie['credits']['crew']);

		return collect($crews)->where('department', 'Production')->sortByDesc('popularity')->take(2)->map(function ($crew) {
			return collect($crew);
		});
	}

	public function getCast()
	{
		$casts = collect($this->movie['credits'])->get('cast');

		return collect($casts)->map(function ($cast) {
			return collect($cast)->merge([
				'profile_path' => $cast['profile_path']
					? 'https://image.tmdb.org/t/p/w300' . $cast['profile_path']
					: 'https://via.placeholder.com/300x450?text=ERROR',
				'link' => $cast['id'] . '/' . Str::slug($cast['name'])
			])->only([
				'id', 'name', 'profile_path', 'link', 'character'
			]);
		});
	}

	public function getImage()
	{
		$images = collect($this->movie['images'])->get('backdrops');

		return collect($images)->map(function ($image) {
			return collect($image)->merge([
				'file_path' => $image['file_path']
					? 'https://image.tmdb.org/t/p/original' . $image['file_path']
					: 'https://via.placeholder.com/750x500?text=ERROR',
			])->only('file_path');
		});
	}

	public function getCollection()
	{
		if ($this->movie['belongs_to_collection'] != null) {
			$collection = collect($this->movie['belongs_to_collection']);

			return collect($collection)->merge([
				'backdrop_path' => $collection['backdrop_path']
					? 'https://image.tmdb.org/t/p/w500' . $collection['backdrop_path']
					: 'https://via.placeholder.com/750x500?text=ERROR',
				'link' => $collection
					? $collection['id'] . '/' . Str::slug($collection['name'])
					: null
			])->only([
				'id', 'backdrop_path', 'name', 'link'
			]);
		}
	}

	public function recommendMovie()
	{
		return collect($this->recommendMovie)->map(function ($movie) {
			return collect($movie)->merge([
				'poster_path' => $movie['poster_path']
					? 'https://image.tmdb.org/t/p/w500' . $movie['poster_path']
					: "https://via.placeholder.com/500x750?text=ERROR",
				'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
				'link' => $movie['id'] . '/' . Str::slug($movie['title']),
				'vote_average' => Str::limit($movie['vote_average'], 3, '')
			])->only([
				'id', 'title', 'release_date', 'poster_path', 'vote_average', 'link'
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

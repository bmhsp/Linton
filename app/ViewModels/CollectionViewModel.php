<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;

class CollectionViewModel extends ViewModel
{
	public $collection;

	public function __construct($collection)
	{
		$this->collection = $collection;
	}

	public function collection()
	{
		return collect($this->collection)->merge([
			'backdrop_path' => $this->collection['backdrop_path']
				? 'https://image.tmdb.org/t/p/w500' . $this->collection['backdrop_path']
				:	'https://via.placeholder.com/750x500',
			'poster_path' => $this->collection['poster_path']
				? 'https://image.tmdb.org/t/p/w500' . $this->collection['poster_path']
				:	'https://via.placeholder.com/500x750',
			'overview' => $this->collection['overview'] ? $this->collection['overview'] : "We don't have enough data for this series"
		]);
	}

	public function getMovie()
	{
		$movies = collect($this->collection)->get('parts');

		return collect($movies)->map(function ($movie) {
			if (isset($movie['release_date'])) {
				$release_date = Carbon::parse($movie['release_date'])->format('d M, Y');
			} else {
				$release_date = 'Future';
			}

			return collect($movie)->merge([
				'poster_path' => $movie['poster_path']
					? 'https://image.tmdb.org/t/p/w500' . $movie['poster_path']
					:	'https://via.placeholder.com/500x750?text=ERROR',
				'backdrop_path' => $movie['backdrop_path']
					? 'https://image.tmdb.org/t/p/w500' . $movie['backdrop_path']
					:	'https://via.placeholder.com/500x281?text=ERROR',
				'vote_average' => Str::limit($movie['vote_average'], 3, ''),
				'release_date' => $release_date,
				'movie_link' => $movie['id'] . '/' . Str::slug($movie['title']),
			]);
		});
	}
}

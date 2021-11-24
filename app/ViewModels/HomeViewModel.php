<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;

class HomeViewModel extends ViewModel
{
	public $movies;
	public $tv;
	public $persons;

	public function __construct($movies, $tv, $persons)
	{
		$this->movies = $movies;
		$this->tv = $tv;
		$this->persons = $persons;
	}

	public function movies()
	{
		return collect($this->movies)->take(6)->map(function ($movie) {
			return collect($movie)->merge([
				'poster_path' => $movie['poster_path']
					? 'https://image.tmdb.org/t/p/w500' . $movie['poster_path']
					: "https://via.placeholder.com/500x750?text=ERROR",
				'link' => $movie['id'] . '/' . Str::slug($movie['title']),
				'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
				'vote_average' => Str::limit($movie['vote_average'], 3, '')
			])->only([
				'poster_path', 'id', 'title', 'vote_average', 'release_date', 'link'
			]);
		});
	}

	public function tv()
	{
		return collect($this->tv)->take(6)->map(function ($tv) {
			return collect($tv)->merge([
				'poster_path' => $tv['poster_path']
					? 'https://image.tmdb.org/t/p/w500' . $tv['poster_path']
					: "https://via.placeholder.com/500x750?text=ERROR",
				'link' => $tv['id'] . '/' . Str::slug($tv['name']),
				'first_air_date' => Carbon::parse($tv['first_air_date'])->format('M d, Y'),
				'vote_average' => Str::limit($tv['vote_average'], 3, '')
			]);
		});
	}

	public function persons()
	{
		return collect($this->persons)->take(6)->map(function ($person) {
			return collect($person)->merge([
				'profile_path' => $person['profile_path']
					? 'https://image.tmdb.org/t/p/w235_and_h235_face/' . $person['profile_path']
					: 'https://ui-avatars.com/api/?size=235&name=' . $person['name'],
				'known_for' => collect($person['known_for'])->where('media_type', 'movie')->pluck('title')->union(
					collect($person['known_for'])->where('media_type', 'tv')->pluck('name')
				)->implode(', '),
				'link' => $person['id'] . '/' . Str::slug($person['name']),
			])->only([
				'name', 'id', 'profile_path', 'known_for', 'link'
			]);;
		});
	}
}

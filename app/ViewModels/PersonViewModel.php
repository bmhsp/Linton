<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;

class PersonViewModel extends ViewModel
{
	public $person;
	public $social;
	public $credits;

	public function __construct($person, $social, $credits)
	{
		$this->person = $person;
		$this->social = $social;
		$this->credits = $credits;
	}

	public function person()
	{
		return collect($this->person)->merge([
			'birthday' => Carbon::parse($this->person['birthday'])->format('d F Y'),
			'age' => Carbon::parse($this->person['birthday'])->age,
			'biography' => $this->person['biography']
				?  $this->person['biography']
				: "We don't have enough data for this person",
			'profile_path' => $this->person['profile_path']
				? 'https://image.tmdb.org/t/p/w300/' . $this->person['profile_path']
				:  'https://ui-avatars.com/api/?size=235&name=' . $this->person['name'],
			'gender' => $this->person['gender'] == '1' ? 'Female' : 'Male',
		]);
	}

	public function social()
	{
		return collect($this->social)->merge([
			'facebook' => $this->social['facebook_id'] ? 'https://facebook.com/' . $this->social['facebook_id'] : null,
			'instagram' => $this->social['instagram_id'] ? 'https://instagram.com/' . $this->social['instagram_id'] : null,
			'twitter' => $this->social['twitter_id'] ? 'https://twitter.com/' . $this->social['twitter_id'] : null,
		]);
	}

	public function credits()
	{
		$credits = collect($this->credits)->get('cast');

		return collect($credits)->map(function ($movie) {
			if (isset($movie['release_date'])) {
				$releaseDate = $movie['release_date'];
			} elseif (isset($movie['first_air_date'])) {
				$releaseDate = $movie['first_air_date'];
			} else {
				$releaseDate = '';
			}

			if (isset($movie['title'])) {
				$title = $movie['title'];
			} elseif (isset($movie['name'])) {
				$title = $movie['name'];
			} else {
				$title = 'Untitled';
			}

			return collect($movie)->merge([
				'release_date' => $releaseDate,
				'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
				'title' => $title,
				'character' => isset($movie['character']) ? $movie['character'] : '',
			]);
		})->sortByDesc('release_date');
	}

	public function getMovies()
	{
		$movies = collect($this->credits)->get('cast');

		return collect($movies)->sortByDesc('popularity')->take(15)->map(function ($movie) {
			if (isset($movie['title'])) {
				$title = $movie['title'];
			} elseif (isset($movie['name'])) {
				$title = $movie['name'];
			} else {
				$title = 'Untitled';
			}

			return collect($movie)->merge([
				'poster_path' => $movie['poster_path']
					? 'https://image.tmdb.org/t/p/w185/' . $movie['poster_path']
					: 'https://via.placeholder.com/185x278?text=ERROR',
				'title' => $title,
				'linkToPage' => $movie['media_type'] === 'movie'
					? '/movies/' . $movie['id'] . '/' .  Str::slug($movie['title'])
					: '/tv/' . $movie['id'] . '/' . Str::slug($movie['name']),
				'character' => $movie['character'] ? $movie['character'] : 'Unknown',
			]);
		});
	}
}

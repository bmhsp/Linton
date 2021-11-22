<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class HomeViewModel extends ViewModel
{
	public $movie;
	public $tv;
	public $person;

	public function __construct($movie, $tv, $person)
	{
		$this->movie = $movie;
		$this->tv = $tv;
		$this->person = $person;
	}

	public function movie()
	{
		return collect($this->movie)->map(function ($movie) {
			return collect($movie)->merge([
				'poster_path' => 'https://image.tmdb.org/t/p/w500' . $movie['poster_path']
			]);
		});
	}

	public function tv()
	{
		return collect($this->tv)->map(function ($tv) {
			return collect($tv)->merge([
				'poster_path' => 'https://image.tmdb.org/t/p/w500' . $tv['poster_path']
			]);
		});
	}

	public function person()
	{
		return collect($this->person)->map(function ($person) {
			return collect($person)->merge([
				'profile_path' => 'https://image.tmdb.org/t/p/w235_and_h235_face' . $person['profile_path']
			]);
		});
	}
}

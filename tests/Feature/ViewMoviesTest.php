<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ViewMovieTest extends TestCase
{
	/** @test */
	public function the_main_page_shows_correct_info()
	{
		Http::fake([
			'https://api.themoviedb.org/3/movie/popular' => $this->fakePopularMovies(),
			'https://api.themoviedb.org/3/movie/popular' => $this->fakeNowPlaying(),
			'https://api.themoviedb.org/3/genre/movie/list' => $this->fakeGenres(),
		]);

		$response = $this->get('/');

		$response->assertSuccessful();
		$response->assertSee('Popular Movies');
		$response->assertSee('Fake Movie');
		$response->assertSee('Western, Action');
		$response->assertSee('Now Playing');
		$response->assertSee('Now Playing Fake Movie');
	}

	/** @test */
	public function the_movie_page_shows_the_correct_info()
	{
		Http::fake([
			'https://api.themoviedb.org/3/movie/*' => $this->fakeSingleMovie(),
		]);

		$response = $this->get('/movies/335983');

		$response->assertSee('Fake Venom');
		$response->assertSee('Tom Hardy');
		$response->assertSee('Executive Producer');
	}

	/** @test */
	public function the_movie_search_dropdown_works_correctly()
	{
		Http::fake([
			'https://api.themoviedb.org/3/search/movie?query=venom' => $this->fakeSearchMovie(),
		]);

		Livewire::test('search-dropdown')
			->assertDontSee('venom')
			->set('search', 'venom')
			->assertSee('Venom');
	}

	private function fakePopularMovies()
	{
		return Http::response([
			'results' => [
				[
					"backdrop_path" => "/MDYanFolbT76dj0gsCbhS2GM5A.jpg",
					"genre_ids" => [
						37,
						28,
					],
					"id" => 859860,
					"original_language" => "en",
					"original_title" => "Fake Movie",
					"poster_path" => "/qKxrBZ8Ts4KHZKp7BT6GAVMLFO2.jpg",
					"release_date" => "Sep 10, 2021",
					"title" => "Fake Movie",
					"vote_average" => 5.7,
				]
			]
		], 200);
	}

	private function fakeNowPlaying()
	{
		return Http::response([
			'results' => [
				[
					"genre_ids" => [
						37,
						28,
					],
					"id" => 859860,
					"original_language" => "en",
					"original_title" => "Now Playing Fake Movie",
					"poster_path" => "/qKxrBZ8Ts4KHZKp7BT6GAVMLFO2.jpg",
					"release_date" => "Sep 10, 2021",
					"title" => "Now Playing Fake Movie",
					"vote_average" => 5.7,
				]
			]
		], 200);
	}

	private function fakeGenres()
	{
		return Http::response([
			"genres" => [
				[
					"id" => 28,
					"name" => "Action"
				],
				[
					"id" => 12,
					"name" => "Adventure"
				],
				[
					"id" => 16,
					"name" => "Animation"
				],
				[
					"id" => 35,
					"name" => "Comedy"
				],
				[
					"id" => 80,
					"name" => "Crime"
				],
				[
					"id" => 99,
					"name" => "Documentary"
				],
				[
					"id" => 18,
					"name" => "Drama"
				],
				[
					"id" => 10751,
					"name" => "Family"
				],
				[
					"id" => 14,
					"name" => "Fantasy"
				],
				[
					"id" => 36,
					"name" => "History"
				],
				[
					"id" => 27,
					"name" => "Horror"
				],
				[
					"id" => 10402,
					"name" => "Music"
				],
				[
					"id" => 9648,
					"name" => "Mystery"
				],
				[
					"id" => 10749,
					"name" => "Romance"
				],
				[
					"id" => 878,
					"name" => "Science Fiction"
				],
				[
					"id" => 10770,
					"name" => "TV Movie"
				],
				[
					"id" => 53,
					"name" => "Thriller"
				],
				[
					"id" => 10752,
					"name" => "War"
				],
				[
					"id" => 37,
					"name" => "Western"
				]
			]
		], 200);
	}

	private function fakeSingleMovie()
	{
		return Http::response([
			"backdrop_path" => "/VuukZLgaCrho2Ar8Scl9HtV3yD.jpg",
			"genres" => [
				[
					"id" => 878,
					"name" => "Science Fiction"
				],
				[
					"id" => 28,
					"name" => "Action"
				]
			],
			"id" => 335983,
			"original_language" => "en",
			"original_title" => "Fake Venom",
			"overview" => "Investigative journalist Eddie Brock attempts a comeback following a scandal, but accidentally becomes the host of Venom, a violent, super powerful alien symbiote. Soon, he must rely on his newfound powers to protect the world from a shadowy organization looking for a symbiote of their own.",
			"poster_path" => "/2uNW4WbgBXL25BAbXGLnLqX71Sw.jpg",
			"release_date" => "2018-09-28",
			"title" => "Fake Venom",
			"video" => false,
			"vote_average" => 6.8,
			"vote_count" => 11553
		], 200);
	}

	private function fakeSearchMovie()
	{
		return Http::response([
			"results" => [
				[
					"id" => 335983,
					"original_language" => "en",
					"original_title" => "Venom",
					"poster_path" => "/2uNW4WbgBXL25BAbXGLnLqX71Sw.jpg",
					"title" => "Venom",
				],
			]
		], 200);
	}
}

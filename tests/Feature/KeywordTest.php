<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KeywordTest extends TestCase
{
	/** @test */
	public function keyword_movie()
	{
		Http::fake([
			'https://api.themoviedb.org/3/discover/movie?with_keywords=*&sort_by=popularity.desc' => $this->fakePopularMovie(),
			'https://api.themoviedb.org/3/discover/movie?with_keywords=*&sort_by=vote_average.desc' => $this->fakeTopRatedMovie(),
			'https://api.themoviedb.org/3/discover/movie?with_keywords=*&sort_by=release_date.desc' => $this->fakeLatestMovie(),
		]);

		$response = $this->get('/keyword/9715/superhero/movie');

		$response->assertSuccessful();
		$response->assertSee('Popular');
		$response->assertSee('Top Rated');
		$response->assertSee('Latest');
	}

	/** @test */
	public function keyword_tv()
	{
		Http::fake([
			'https://api.themoviedb.org/3/discover/tv?with_keywords=*&sort_by=popularity.desc' => $this->fakePopularTv(),
			'https://api.themoviedb.org/3/discover/tv?with_keywords=*&sort_by=vote_average.desc' => $this->fakeTopRatedTv(),
			'https://api.themoviedb.org/3/discover/tv?with_keywords=*&sort_by=first_air_date.desc' => $this->fakeLatestTv(),
		]);

		$response = $this->get('/keyword/210024/anime/tv');

		$response->assertSuccessful();
		$response->assertSee('Popular');
		$response->assertSee('Top Rated');
		$response->assertSee('Latest');
	}



	private function fakePopularMovie()
	{
		return Http::response([
			'results' => [
				[
					"backdrop_path" => "/cinER0ESG0eJ49kXlExM0MEWGxW.jpg",
					"genre_ids" => [
						28,
						12,
						14
					],
					"id" => 566525,
					"popularity" => 5225.504,
					"poster_path" => "/1BIoJGKbXjdFDAqUEiA2VHqkK1Z.jpg",
					"release_date" => "2021-09-01",
					"title" => "Shang-Chi and the Legend of the Ten Rings",
					"vote_average" => 7.9,
				]
			]
		], 200);
	}

	private function fakeTopRatedMovie()
	{
		return Http::response([
			'results' => [
				[
					"backdrop_path" => null,
					"id" => 877451,
					"popularity" => 5.437,
					"poster_path" => "/wjSuGRe0pzGMfjDoGzbrlJhv0Xs.jpg",
					"release_date" => "2021-09-23",
					"title" => "Go! Saitama",
					"vote_average" => 10,
				]
			]
		], 200);
	}

	private function fakeLatestMovie()
	{
		return Http::response([
			'results' => [
				[
					"backdrop_path" => "/dbuR6XuVubN5ZmRUiOycZi2457l.jpg",
					"id" => 640146,
					"popularity" => 13.801,
					"poster_path" => "/mYCBuVGQGWPlUNZQusdHfbSzP1h.jpg",
					"release_date" => "2023-07-27",
					"title" => "Ant-Man and the Wasp => Quantumania",
					"vote_average" => 0,
				]
			]
		], 200);
	}

	private function fakePopularTv()
	{
		return Http::response([
			'results' => [
				[
					"backdrop_path" => "/oycArCLGgtWyUz5aho7ojFZkgjN.jpg",
					"first_air_date" => "2002-10-03",
					"id" => 46260,
					"name" => "Naruto",
					"popularity" => 435.33,
					"poster_path" => "/vauCEnR7CiyBDzRCeElKkCaXIYu.jpg",
					"vote_average" => 8.4,
				]
			]
		], 200);
	}

	private function fakeTopRatedTv()
	{
		return Http::response([
			'results' => [
				[
					"backdrop_path" => null,
					"first_air_date" => "1996-07-24",
					"id" => 126181,
					"name" => "Maze",
					"popularity" => 1.121,
					"poster_path" => "/rhajrzNOoc8C8jAuytih4bEqr83.jpg",
					"vote_average" => 10,
				]
			]
		], 200);
	}

	private function fakeLatestTv()
	{
		return Http::response([
			'results' => [
				[
					"backdrop_path" => "/n6lrRYzU5zzSsEuy7zCVJRXS4Ye.jpg",
					"first_air_date" => "2022-01-28",
					"id" => 138190,
					"name" => "The Orbital Children",
					"popularity" => 1.526,
					"poster_path" => "/jB8eso4BUNO4F3EQfMC3GzVQGT9.jpg",
					"vote_average" => 0,
				]
			]
		], 200);
	}
}

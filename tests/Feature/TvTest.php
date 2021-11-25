<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TvTest extends TestCase
{
	/** @test */
	public function tv_index()
	{
		Http::fake([
			'https://api.themoviedb.org/3/tv/airing_today' => $this->fakeAiringToday(),
			'https://api.themoviedb.org/3/tv/on_the_air' => $this->fakeOnTheAir(),
			'https://api.themoviedb.org/3/tv/popular' => $this->fakePopular(),
			'https://api.themoviedb.org/3/tv/top_rated' => $this->fakeTopRated(),
		]);

		$response = $this->get('/tv');

		$response->assertSuccessful();
		$response->assertSee('airing today');
		$response->assertSee('on the air');
		$response->assertSee('popular');
		$response->assertSee('top rated');
	}

	/** @test */
	public function tv_show()
	{
		Http::fake([
			'https://api.themoviedb.org/3/tv/*' => $this->fakeSingleTv(),
			'https://api.themoviedb.org/3/tv/*/recommendations' => $this->fakeRecommendations(),
			'https://api.themoviedb.org/3/tv/popular/*/keywords' => $this->fakeKeywords(),
		]);

		$response = $this->get('/tv/83095/the-rising-of-the-shield-hero');

		// $response->assertSuccessful();
		$response->assertSee('The Rising of the Shield Hero');
		$response->assertSee('Cast');
		$response->assertSee('Images');
		$response->assertSee('Recommended');
	}



	private function fakeAiringToday()
	{
		return Http::response([
			'results' => [
				[
					"backdrop_path" => "/pkOSjcllDSs4WP9i8DGkw9VgF5Q.jpg",
					"first_air_date" => "2015-07-06",
					"genre_ids" => [
						10764,
						10751
					],
					"id" => 63452,
					"name" => "Wer weiß denn sowas?",
					"poster_path" => "/abKjah96esLWObidBcWmvKJv61E.jpg",
					"vote_average" => 8,
				]
			]
		], 200);
	}

	private function fakeOnTheAir()
	{
		return Http::response([
			'results' => [
				[
					"backdrop_path" => "/xAKMj134XHQVNHLC6rWsccLMenG.jpg",
					"first_air_date" => "2021-10-12",
					"id" => 90462,
					"name" => "Chucky",
					"poster_path" => "/iF8ai2QLNiHV4anwY1TuSGZXqfN.jpg",
					"vote_average" => 8,
				]
			]
		], 200);
	}

	private function fakePopular()
	{
		return Http::response([
			'results' => [
				[
					"backdrop_path" => "/xAKMj134XHQVNHLC6rWsccLMenG.jpg",
					"first_air_date" => "2021-10-12",
					"id" => 90462,
					"name" => "Chucky",
					"poster_path" => "/iF8ai2QLNiHV4anwY1TuSGZXqfN.jpg",
					"vote_average" => 8,
				]
			]
		], 200);
	}

	private function fakeTopRated()
	{
		return Http::response([
			'results' => [
				[
					"backdrop_path" => "/7q448EVOnuE3gVAx24krzO7SNXM.jpg",
					"first_air_date" => "2021-09-03",
					"id" => 130392,
					"name" => "The D'Amelio Show",
					"poster_path" => "/z0iCS5Znx7TeRwlYSd4c01Z0lFx.jpg",
					"vote_average" => 9.4,
				]
			]
		], 200);
	}

	private function fakeSingleTv()
	{
		return Http::response([
			"backdrop_path" => "/qSgBzXdu6QwVVeqOYOlHolkLRxZ.jpg",
			"created_by" => [
				[
					"id" => 3017047,
					"credit_id" => "61361ac4ea39490044631f54",
					"name" => "Aneko Yusagi",
				]
			],
			"episode_run_time" => [
				24
			],
			"first_air_date" => "2019-01-09",
			"genres" => [
				[
					"id" => 16,
					"name" => "Animation"
				],
				[
					"id" => 10759,
					"name" => "Action & Adventure"
				],
				[
					"id" => 10765,
					"name" => "Sci-Fi & Fantasy"
				],
				[
					"id" => 18,
					"name" => "Drama"
				]
			],
			"homepage" => "http://shieldhero-anime.jp/",
			"id" => 83095,
			"name" => "The Rising of the Shield Hero",
			"networks" => [
				[
					"name" => "AT-X",
					"id" => 173,
					"logo_path" => "/fERjndErEpveJmQZccJbJDi93rj.png",
					"origin_country" => "JP"
				],
				[
					"name" => "TV Aichi",
					"id" => 252,
					"logo_path" => "/zFZ5KCuvx7K0vP9XgGcidfXjuUd.png",
					"origin_country" => "JP"
				],
				[
					"name" => "Tokyo MX",
					"id" => 614,
					"logo_path" => "/3qFArHw6nrFIdkH2tPht701sNhs.png",
					"origin_country" => "JP"
				],
				[
					"name" => "Sun TV",
					"id" => 817,
					"logo_path" => "/5g8LER5X7tvziu3We71m9HnBmy6.png",
					"origin_country" => "JP"
				],
				[
					"name" => "TVQ",
					"id" => 822,
					"logo_path" => "/koirj3XCAq3J6OK3YpNepJIq7lO.png",
					"origin_country" => "JP"
				],
				[
					"name" => "BS11",
					"id" => 861,
					"logo_path" => "/JQ5bx6n7Qmdmyqz6sqjo5Fz2iR.png",
					"origin_country" => "JP"
				],
				[
					"name" => "KBS Kyoto",
					"id" => 1137,
					"logo_path" => "/j12pSWPsDBxE1mmIpB7M8VRzk78.png",
					"origin_country" => "JP"
				]
			],
			"number_of_episodes" => 26,
			"number_of_seasons" => 3,
			"origin_country" => [
				"JP"
			],
			"original_name" => "盾の勇者の成り上がり",
			"overview" => "Iwatani Naofumi was summoned into a parallel world along with 3 other people to become the world's Heroes. Each of the heroes respectively equipped with their own legendary equipment when summoned, Naofumi received the Legendary Shield as his weapon. Due to Naofumi's lack of charisma and experience he's labeled as the weakest, only to end up betrayed, falsely accused, and robbed by on the third day of adventure. Shunned by everyone from the king to peasants, Naofumi's thoughts were filled with nothing but vengeance and hatred. Thus, his destiny in a parallel World begins...",
			"poster_path" => "/6cXf5EDwVhsRv8GlBzUTVnWuk8Z.jpg",
			"production_countries" => [
				[
					"iso_3166_1" => "JP",
					"name" => "Japan"
				]
			],
			"seasons" => [
				[
					"air_date" => "2019-01-09",
					"episode_count" => 25,
					"id" => 110814,
					"name" => "Season 1",
					"poster_path" => "/VSxgt1WBqkI1Wf65zQNiU32xHv.jpg",
					"season_number" => 1
				],
				[
					"air_date" => "2022-04-30",
					"episode_count" => 1,
					"id" => 161486,
					"name" => "Season 2",
					"poster_path" => "/e4RIMyEx261EsnlSkl4eE2YMLSE.jpg",
					"season_number" => 2
				],
				[
					"air_date" => null,
					"episode_count" => 0,
					"id" => 207548,
					"name" => "Season 3",
					"poster_path" => "/tr4nyK9ITNfsspNuDpWsT9W5Zo3.jpg",
					"season_number" => 3
				]
			],
			"status" => "Returning Series",
			"tagline" => "Doubt, distrust, and suspect everyone. All the world is the enemy.",
			"type" => "Scripted",
			"vote_average" => 9,
		], 200);
	}

	private function fakeRecommendations()
	{
		return Http::response([
			'results' => [
				[
					"adult" => false,
					"backdrop_path" => "/pDmfA1mRdd0LrQm566YIFuZQTYO.jpg",
					"id" => 86034,
					"media_type" => "tv",
					"name" => "Arifureta: From Commonplace to World's Strongest",
					"poster_path" => "/kB9tdE00Z5zWIJQux1jiYvRyPIC.jpg",
					"first_air_date" => "2019-07-08",
					"vote_average" => 8.708,
				]
			]
		], 200);
	}

	private function fakeKeywords()
	{
		return Http::response([
			'results' => [
				[
					"name" => "saving the world",
					"id" => 83
				],
				[
					"name" => "magic",
					"id" => 2343
				],
				[
					"name" => "anti hero",
					"id" => 2095
				],
				[
					"name" => "training",
					"id" => 4613
				],
				[
					"name" => "dysfunctional family",
					"id" => 10041
				],
				[
					"name" => "romance",
					"id" => 9840
				],
				[
					"name" => "betrayal",
					"id" => 10085
				],
				[
					"name" => "religion",
					"id" => 11001
				],
				[
					"name" => "sibling rivalry",
					"id" => 11157
				],
				[
					"name" => "dragon",
					"id" => 12554
				],
				[
					"name" => "parallel world",
					"id" => 33465
				],
				[
					"name" => "dark fantasy",
					"id" => 177895
				],
				[
					"name" => "seinen",
					"id" => 195668
				],
				[
					"name" => "based on light novel",
					"id" => 209666
				],
				[
					"name" => "anime",
					"id" => 210024
				],
				[
					"name" => "corrupt church",
					"id" => 236595
				],
				[
					"name" => "isekai",
					"id" => 237451
				]
			]
		], 200);
	}
}

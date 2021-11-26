<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NetworkTest extends TestCase
{
	/** @test */
	public function network_index()
	{
		Http::fake([
			'https://api.themoviedb.org/3/network/*' => $this->fakeNetwork(),
			'https://api.themoviedb.org/3/discover/tv?with_networks=*' => $this->fakeTvInfo(),
		]);

		$response = $this->get('/network/179/at-x');

		$response->assertSuccessful();
		$response->assertSee('AT-X');
	}



	private function fakeNetwork()
	{
		return Http::response([
			"headquarters" => "Minato, Tokyo Prefecture",
			"homepage" => "https://www.at-x.com",
			"id" => 173,
			"logo_path" => "/fERjndErEpveJmQZccJbJDi93rj.png",
			"name" => "AT-X",
			"origin_country" => "JP"
		], 200);
	}

	private function fakeTvInfo()
	{
		return Http::response([
			'results' => [
				[
					"backdrop_path" => "/wUSXlvGJqVLnvriGaVEY4m5Ib4K.jpg",
					"first_air_date" => "2021-10-03",
					"id" => 121078,
					"name" => "Mieruko-chan",
					"popularity" => 272.583,
					"poster_path" => "/meTZrStWnxQH3Kh8cxqGC6lKkcA.jpg",
					"vote_average" => 7.3,
				]
			]
		], 200);
	}
}

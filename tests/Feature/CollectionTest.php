<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CollectionTest extends TestCase
{
	/** @test */
	public function collection_index()
	{
		Http::fake([
			'https://api.themoviedb.org/3/collection/*' => $this->fakeCollection()
		]);

		$response = $this->get('/collection/558216/venom-collection');

		$response->assertSee('Venom Collection');
		$response->assertSee('Venom: Let There Be Carnage');
		$response->assertSee('Venom');
	}

	private function fakeCollection()
	{
		return Http::response([
			"id" => 558216,
			"name" => "Venom Collection",
			"overview" => "A frustrated journalist named Eddie Brock and a carnivorous black symbiote unite to become the monstrous antihero Venom and battle both good and evil alike. Based on the Marvel Comics character.",
			"poster_path" => "/670x9sf0Ru8y6ezBggmYudx61yB.jpg",
			"backdrop_path" => "/rhLspFB1B8ZCkWEHFYmc3NKagzq.jpg",
			"parts" => [
				[
					"release_date" => "2021-09-30",
					"backdrop_path" => "/70nxSw3mFBsGmtkvcs91PbjerwD.jpg",
					"title" => "Venom: Let There Be Carnage",
					"poster_path" => "/rjkmN1dniUHVYAtwuV3Tji7FsDO.jpg",
					"vote_average" => 7.2,
					"id" => 580489,
				],
				[
					"poster_path" => "/2uNW4WbgBXL25BAbXGLnLqX71Sw.jpg",
					"vote_average" => 6.8,
					"id" => 335983,
					"title" => "Venom",
					"backdrop_path" => "/VuukZLgaCrho2Ar8Scl9HtV3yD.jpg",
					"release_date" => "2018-09-28",
				]
			]
		], 200);
	}
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
  /** @test */
  public function home_index()
  {
    Http::fake([
      'https://api.themoviedb.org/3/trending/movie/day' => $this->fakeMovies(),
      'https://api.themoviedb.org/3/trending/tv/day' => $this->fakeTv(),
      'https://api.themoviedb.org/3/trending/person/day' => $this->fakePersons()
    ]);

    $response = $this->get('/');

    $response->assertSuccessful();
    $response->assertSee('trending movies');
    $response->assertSee('trending tv shows');
    $response->assertSee('trending people');
  }

  private function fakeMovies()
  {
    return Http::response([
      'results' => [
        [
          "release_date" => "2021-09-30",
          "backdrop_path" => "/70nxSw3mFBsGmtkvcs91PbjerwD.jpg",
          "title" => "Venom: Let There Be Carnage",
          "original_title" => "Venom: Let There Be Carnage",
          "poster_path" => "/rjkmN1dniUHVYAtwuV3Tji7FsDO.jpg",
          "vote_average" => 7.2,
          "id" => 580489,
          "media_type" => "movie"
        ]
      ]
    ], 200);
  }

  private function fakeTv()
  {
    return Http::response([
      'results' => [
        [
          "vote_average" => 9,
          "first_air_date" => "2021-11-24",
          "backdrop_path" => "/1R68vl3d5s86JsS2NPjl8UoMqIS.jpg",
          "name" => "Hawkeye",
          "vote_count" => 96,
          "id" => 88329,
          "poster_path" => "/5BxY6UN0e7wAE5LUQVVj39JAItM.jpg",
          "original_name" => "Hawkeye",
          "media_type" => "tv"
        ]
      ]
    ], 200);
  }

  private function fakePersons()
  {
    return Http::response([
      'results' => [
        [
          "name" => "Jason Statham",
          "gender" => 2,
          "known_for" => [
            [
              "overview" => "Hobbs has Dominic and Brian reassemble their crew to take down a team of mercenaries => Dominic unexpectedly gets convoluted also facing his presumed deceased girlfriend, Letty.",
              "media_type" => "movie",
              "title" => "Fast & Furious 6",
              "poster_path" => "/n31VRDodbaZxkrZmmzyYSFNVpW5.jpg",
              "id" => 82992,
              "vote_average" => 6.8,
            ]
          ],
          "profile_path" => "/lldeQ91GwIVff43JBrpdbAAeYWj.jpg",
          "known_for_department" => "Acting",
          "id" => 976,
          "media_type" => "person"
        ]
      ]
    ], 200);
  }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GenreTest extends TestCase
{
  /** @test */
  public function genre_movie()
  {
    Http::fake([
      'https://api.themoviedb.org/3/discover/movie?with_genres=*&sort_by=popularity.desc' => $this->fakePopularMovie(),
      'https://api.themoviedb.org/3/discover/movie?with_genres=*&sort_by=vote_average.desc' => $this->fakeTopRatedMovie(),
      'https://api.themoviedb.org/3/discover/movie?with_genres=*&sort_by=release_date.desc' => $this->fakeLatestMovie(),
    ]);

    $response = $this->get('/genre/28/action/movie');

    $response->assertSuccessful();
    $response->assertSee('Popular');
    $response->assertSee('Top Rated');
    $response->assertSee('Latest');
  }

  /** @test */
  public function genre_tv()
  {
    Http::fake([
      'https://api.themoviedb.org/3/discover/tv?with_genres=*&sort_by=popularity.desc' => $this->fakePopularTv(),
      'https://api.themoviedb.org/3/discover/tv?with_genres=*&sort_by=vote_average.desc' => $this->fakeTopRatedTv(),
      'https://api.themoviedb.org/3/discover/tv?with_genres=*&sort_by=first_air_date.desc' => $this->fakeLatestTv(),
    ]);

    $response = $this->get('/genre/16/action/tv');

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
          "backdrop_path" => "/awywFyhAFaa8VHimmD8XU3pRatA.jpg",
          "id" => 901311,
          "popularity" => 0.737,
          "poster_path" => "/60VlWjh99jqpIFFOyEYA5JC0rqQ.jpg",
          "release_date" => "2019-12-22",
          "title" => "The Quest for the Magic Bands",
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
          "backdrop_path" => null,
          "id" => 393209,
          "popularity" => 20.796,
          "poster_path" => "/qeAknsrFRHRvjIq2HrlBsmYy2KL.jpg",
          "release_date" => "2028-12-20",
          "title" => "Avatar 5",
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
          "backdrop_path" => "/rkB4LyZHo1NHXFEDHl9vSD9r1lI.jpg",
          "first_air_date" => "2021-11-06",
          "id" => 94605,
          "name" => "Arcane",
          "popularity" => 1564.24,
          "poster_path" => "/fqldf2t8ztc9aiwn3k6mlX3tvRT.jpg",
          "vote_average" => 9.2,
        ]
      ]
    ], 200);
  }

  private function fakeTopRatedTv()
  {
    return Http::response([
      'results' => [
        [
          "backdrop_path" => "/zf1KGj4juSE6rmS8lSop1HRx3YV.jpg",
          "first_air_date" => "2014-08-16",
          "id" => 137892,
          "name" => "Hanamonogatari",
          "popularity" => 0.6,
          "poster_path" => "/aYAyhf82JIxmlGbFG1rXQkdLnXT.jpg",
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
          "backdrop_path" => null,
          "first_air_date" => "2024-07-04",
          "id" => 136550,
          "name" => "My Personal Hell",
          "popularity" => 0.6,
          "poster_path" => null,
          "vote_average" => 0,
        ]
      ]
    ], 200);
  }
}

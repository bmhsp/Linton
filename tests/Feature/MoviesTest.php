<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MoviesTest extends TestCase
{
  /** @test */
  public function movies_index()
  {
    Http::fake([
      'https://api.themoviedb.org/3/movie/now_playing' => $this->fakeNowPlaying(),
      'https://api.themoviedb.org/3/movie/popular' => $this->fakePopular(),
      'https://api.themoviedb.org/3/movie/top_rated' => $this->fakeTopRated(),
      'https://api.themoviedb.org/3/movie/upcoming' => $this->fakeUpcoming(),
    ]);

    $response = $this->get('/movies');

    $response->assertSuccessful();
    $response->assertSee('now playing');
    $response->assertSee('popular');
    $response->assertSee('top rated');
    $response->assertSee('upcoming');
  }

  /** @test */
  public function movies_show()
  {
    Http::fake([
      'https://api.themoviedb.org/3/movie/*' => $this->fakeSingleMovie(),
      'https://api.themoviedb.org/3/movie/*/recommendations' => $this->fakeRecommendations(),
      'https://api.themoviedb.org/3/movie/*/keywords' => $this->fakeKeywords(),
    ]);

    $response = $this->get('/movies/566525/shang-chi-and-the-legend-of-the-ten-rings');

    // $response->assertSuccessful();
    $response->assertSee('Shang-Chi and the Legend of the Ten Rings');
    $response->assertSee('Cast');
    $response->assertSee('Info');
    $response->assertSee('Images');
    $response->assertSee('Recommended');
  }



  private function fakeNowPlaying()
  {
    return Http::response([
      'results' => [
        [
          "backdrop_path" => "/cinER0ESG0eJ49kXlExM0MEWGxW.jpg",
          "id" => 566525,
          "poster_path" => "/1BIoJGKbXjdFDAqUEiA2VHqkK1Z.jpg",
          "release_date" => "2021-09-01",
          "title" => "Shang-Chi and the Legend of the Ten Rings",
          "vote_average" => 7.9,
        ]
      ]
    ], 200);
  }

  private function fakePopular()
  {
    return Http::response([
      'results' => [
        [
          "backdrop_path" => "/cinER0ESG0eJ49kXlExM0MEWGxW.jpg",
          "id" => 566525,
          "poster_path" => "/1BIoJGKbXjdFDAqUEiA2VHqkK1Z.jpg",
          "release_date" => "2021-09-01",
          "title" => "Shang-Chi and the Legend of the Ten Rings",
          "vote_average" => 7.9,
        ]
      ]
    ], 200);
  }

  private function fakeTopRated()
  {
    return Http::response([
      'results' => [
        [
          "backdrop_path" => "/5hNcsnMkwU2LknLoru73c76el3z.jpg",
          "id" => 19404,
          "poster_path" => "/2CAL2433ZeIihfX1Hb2139CX0pW.jpg",
          "release_date" => "1995-10-20",
          "title" => "Dilwale Dulhania Le Jayenge",
          "vote_average" => 8.7,
        ]
      ]
    ], 200);
  }

  private function fakeUpcoming()
  {
    return Http::response([
      'results' => [
        [
          "backdrop_path" => "/70nxSw3mFBsGmtkvcs91PbjerwD.jpg",
          "id" => 580489,
          "poster_path" => "/rjkmN1dniUHVYAtwuV3Tji7FsDO.jpg",
          "release_date" => "2021-09-30",
          "title" => "Venom: Let There Be Carnage",
          "vote_average" => 7.2,
        ]
      ]
    ], 200);
  }

  private function fakeSingleMovie()
  {
    return Http::response([
      "backdrop_path" => "/cinER0ESG0eJ49kXlExM0MEWGxW.jpg",
      "belongs_to_collection" => null,
      "budget" => 150000000,
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
          "id" => 14,
          "name" => "Fantasy"
        ],
      ],
      "homepage" => "https =>//www.marvel.com/movies/shang-chi-and-the-legend-of-the-ten-rings",
      "id" => 566525,
      "original_title" => "Shang-Chi and the Legend of the Ten Rings",
      "overview" => "Shang-Chi must confront the past he thought he left behind when he is drawn into the web of the mysterious Ten Rings organization.",
      "poster_path" => "/1BIoJGKbXjdFDAqUEiA2VHqkK1Z.jpg",
      "production_companies" => [
        [
          "id" => 420,
          "logo_path" => "/hUzeosd33nzE5MCNsZxCGEKTXaQ.png",
          "name" => "Marvel Studios",
          "origin_country" => "US"
        ]
      ],
      "production_countries" => [
        [
          "iso_3166_1" => "US",
          "name" => "United States of America"
        ]
      ],
      "release_date" => "2021-09-01",
      "revenue" => 430238384,
      "runtime" => 132,
      "status" => "Released",
      "tagline" => "You can't outrun your destiny.",
      "title" => "Shang-Chi and the Legend of the Ten Rings",
      "video" => false,
      "vote_average" => 7.9,
    ], 200);
  }

  private function fakeRecommendations()
  {
    return Http::response([
      'results' => [
        [
          "backdrop_path" => "/oE6bhqqVFyIECtBzqIuvh6JdaB5.jpg",
          "id" => 522402,
          "media_type" => "movie",
          "title" => "Finch",
          "original_title" => "Finch",
          "poster_path" => "/jKuDyqx7jrjiR9cDzB5pxzhJAdv.jpg",
          "release_date" => "2021-11-04",
          "vote_average" => 8.245,
        ]
      ]
    ], 200);
  }

  private function fakeKeywords()
  {
    return Http::response([
      'keywords' => [
        [
          "id" => 779,
          "name" => "martial arts"
        ],
        [
          "id" => 9715,
          "name" => "superhero"
        ],
        [
          "id" => 9717,
          "name" => "based on comic"
        ],
        [
          "id" => 9917,
          "name" => "mixed martial arts"
        ],
        [
          "id" => 179431,
          "name" => "duringcreditsstinger"
        ],
        [
          "id" => 180547,
          "name" => "marvel cinematic universe (mcu)"
        ],
        [
          "id" => 265894,
          "name" => "marvel comics"
        ]
      ]
    ], 200);
  }
}

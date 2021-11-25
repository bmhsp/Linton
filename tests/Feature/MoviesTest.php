<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MoviesTest extends TestCase
{
  /** @test */
  public function movies()
  {
    Http::fake([
      'https://api.themoviedb.org/3/movie/now_playing' => $this->fakeNowPlaying(),
      'https://api.themoviedb.org/3/movie/popular' => $this->fakePopular(),
      'https://api.themoviedb.org/3/movie/top_rated' => $this->fakeTopRated(),
      'https://api.themoviedb.org/3/movie/upcoming' => $this->fakeUpcoming(),
      'https://api.themoviedb.org/3/genre/movie/list' => $this->fakeGenres()
    ]);

    $response = $this->get('/movies');

    $response->assertSuccessful();
    $response->assertSee('now playing');
    $response->assertSee('popular');
    $response->assertSee('top rated');
    $response->assertSee('upcoming');
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
}

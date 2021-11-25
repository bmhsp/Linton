<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PersonsTest extends TestCase
{
  /** @test */
  public function persons_index()
  {
    Http::fake([
      'https://api.themoviedb.org/3/perosn/popular' => $this->fakePopular(),
    ]);

    $response = $this->get('/person');

    $response->assertSuccessful();
    $response->assertSee('Popular People');
  }

  /** @test */
  public function persons_show()
  {
    Http::fake([
      'https://api.themoviedb.org/3/person/*' => $this->fakeSinglePerson(),
      'https://api.themoviedb.org/3/person/*/external_ids' => $this->fakeSocial(),
      'https://api.themoviedb.org/3/person/*/combined_credits' => $this->fakeCredits(),
    ]);

    $response = $this->get('/person/10859/ryan-reynolds');

    // $response->assertSuccessful();
    $response->assertSee('Ryan Reynolds');
    $response->assertSee('Info');
    $response->assertSee('Known For');
  }



  private function fakePopular()
  {
    return Http::response([
      'results' => [
        [
          "gender" => 2,
          "id" => 10859,
          "known_for" => [
            [
              "id" => 293660,
              "media_type" => "movie",
              "title" => "Deadpool",
            ],
            [
              "id" => 383498,
              "media_type" => "movie",
              "title" => "Deadpool 2",
            ],
            [
              "id" => 72105,
              "media_type" => "movie",
              "title" => "Ted",
            ]
          ],
          "known_for_department" => "Acting",
          "name" => "Ryan Reynolds",
          "popularity" => 56.571,
          "profile_path" => "/4SYTH5FdB0dAORV98Nwg3llgVnY.jpg"
        ]
      ]
    ], 200);
  }

  private function fakeSinglePerson()
  {
    return Http::response([
      "also_known_as" => [
        "Райан Рейнольдс",
        "رايان رينولدز",
        "라이언 레이놀즈",
        "ライアン・レイノルズ",
        "ไรอัน เรย์โนลส์",
        "萊恩·雷諾斯",
        "Раян Рейнольдс",
        "Ryan Rodney Reynolds",
        "Ράιαν Ρέινολντς",
        "瑞安·雷诺兹",
        "Champ Nightengale",
        "রায়ান রেনল্ডস্"
      ],
      "biography" => "Ryan Rodney Reynolds (born 23 October 1976) is a Canadian-American actor, film producer, and entrepreneur. He began his career starring in the Canadian teen soap opera Hillside (1991–1993) and had minor roles before landing the lead role on the sitcom Two Guys and a Girl between 1998 and 2001.\n\nReynolds then starred in a range of films, including Van Wilder (2002), Waiting... (2005), and The Proposal (2009). He also performed in dramatic roles in Buried (2010), Woman in Gold (2015), and Life (2017), starred in action films such as Blade: Trinity (2004), Deadpool (2016), and 6 Underground (2019) and provided voice acting in the animated features The Croods (2013), Turbo (2013), and Pokemon: Detective Pikachu (2019).\n\nReynolds's biggest commercial success came with the superhero films Deadpool (2016) and Deadpool 2 (2018), in which he played the title character. The former set numerous records at the time of its release for an R-rated comedy and his performance earned him nominations at the Critics' Choice Movie Awards and the Golden Globe Awards.\n\nDescription above is from the Wikipedia article Ryan Reynolds, licensed under CC-BY-SA, full list of contributors on Wikipedia.",
      "birthday" => "1976-10-23",
      "deathday" => null,
      "gender" => 2,
      "homepage" => null,
      "id" => 10859,
      "known_for_department" => "Acting",
      "name" => "Ryan Reynolds",
      "place_of_birth" => "Vancouver, Canada",
      "popularity" => 56.571,
      "profile_path" => "/4SYTH5FdB0dAORV98Nwg3llgVnY.jpg"
    ], 200);
  }

  private function fakeSocial()
  {
    return Http::response([
      "id" => 10859,
      "freebase_mid" => "/m/036hf4",
      "freebase_id" => "/en/ryan_reynolds",
      "imdb_id" => "nm0005351",
      "tvrage_id" => 47752,
      "facebook_id" => "VancityReynolds",
      "instagram_id" => "vancityreynolds",
      "twitter_id" => "VancityReynolds"
    ], 200);
  }

  private function fakeCredits()
  {
    return Http::response([
      'cast' => [
        [
          "poster_path" => "/jgs2mdFlx8NJzbxXTHeQxvQbN6n.jpg",
          "id" => 10033,
          "vote_average" => 6.2,
          "release_date" => "2005-11-23",
          "backdrop_path" => "/oAfxQnTlfTKmr61RjE3NM2DlzUN.jpg",
          "title" => "Just Friends",
          "popularity" => 19.232,
          "character" => "Chris Brander",
          "credit_id" => "52fe430e9251416c75001bed",
          "order" => 0,
          "media_type" => "movie"
        ]
      ]
    ], 200);
  }
}

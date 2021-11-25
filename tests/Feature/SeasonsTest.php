<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeasonsTest extends TestCase
{
  /** @test */
  public function season_index()
  {
    Http::fake([
      'https://api.themoviedb.org/3/tv/*' => $this->fakeSeasons(),
    ]);

    $response = $this->get('/tv/83095/the-rising-of-the-shield-hero/seasons');

    // $response->assertSuccessful();
    $response->assertSee('Season 1');
  }

  /** @test */
  public function season_show()
  {
    Http::fake([
      'https://api.themoviedb.org/3/tv/*/season/*' => $this->fakeSingleSeason(),
      'https://api.themoviedb.org/3/tv/*' => $this->fakeTvInfo(),
    ]);

    $response = $this->get('/tv/83095/season/1');

    // $response->assertSuccessful();
    $response->assertSee('Season 1');
    $response->assertSee('The Shield Hero');
  }



  private function fakeSeasons()
  {
    return Http::response([
      "id" => 83095,
      "original_name" => "盾の勇者の成り上がり",
      "name" => "The Rising of the Shield Hero",
      "backdrop_path" => "/qSgBzXdu6QwVVeqOYOlHolkLRxZ.jpg",
      'seasons' => [
        [
          "air_date" => "2019-01-09",
          "episode_count" => 25,
          "id" => 110814,
          "name" => "Season 1",
          "overview" => "The Four Cardinal Heroes are a group of ordinary men from modern-day Japan summoned to the kingdom of Melromarc to become its saviors. Melromarc is a country plagued by the Waves of Catastrophe that have repeatedly ravaged the land and brought disaster to its citizens for centuries. The four heroes are respectively bestowed a sword, spear, bow, and shield to vanquish these Waves. Naofumi Iwatani, an otaku, becomes cursed with the fate of being the \"Shield Hero.\" Armed with only a measly shield, Naofumi is belittled and ridiculed by his fellow heroes and the kingdom's people due to his weak offensive capabilities and lackluster personality.\n\nAs the Waves approach the kingdom, Naofumi and Raphtalia must fight for the survival of the kingdom and protect the people of Melromarc from their ill-fated future.",
          "poster_path" => "/VSxgt1WBqkI1Wf65zQNiU32xHv.jpg",
          "season_number" => 1
        ]
      ]
    ], 200);
  }

  private function fakeSingleSeason()
  {
    return Http::response([
      "_id" => "5bc27f0592514179bc03516f",
      "air_date" => "2019-01-09",
      "overview" => "The Four Cardinal Heroes are a group of ordinary men from modern-day Japan summoned to the kingdom of Melromarc to become its saviors. Melromarc is a country plagued by the Waves of Catastrophe that have repeatedly ravaged the land and brought disaster to its citizens for centuries. The four heroes are respectively bestowed a sword, spear, bow, and shield to vanquish these Waves. Naofumi Iwatani, an otaku, becomes cursed with the fate of being the \"Shield Hero.\" Armed with only a measly shield, Naofumi is belittled and ridiculed by his fellow heroes and the kingdom's people due to his weak offensive capabilities and lackluster personality.\n\nAs the Waves approach the kingdom, Naofumi and Raphtalia must fight for the survival of the kingdom and protect the people of Melromarc from their ill-fated future.",
      "episodes" => [
        [
          "air_date" => "2019-01-09",
          "episode_number" => 1,
          "crew" => [
            [
              "job" => "Animation Director",
              "department" => "Visual Effects",
              "credit_id" => "606b09dc0d2f530029325e2c",
              "adult" => false,
              "gender" => 2,
              "id" => 3038779,
              "known_for_department" => "Visual Effects",
              "name" => "Yoshiaki Taniguchi",
              "original_name" => "Yoshiaki Taniguchi",
              "popularity" => 0.6,
              "profile_path" => null
            ],
          ],
          "guest_stars" => [
            [
              "character" => "Tsukai Yari (voice)",
              "credit_id" => "6028ebe03a48c5003f0d3238",
              "order" => 2,
              "adult" => false,
              "gender" => 1,
              "id" => 2977326,
              "known_for_department" => "Acting",
              "name" => "Tamaki Orie",
              "original_name" => "Tamaki Orie",
              "popularity" => 0.6,
              "profile_path" => "/lq4XGdKqdEdLa57AZkiKtqoVAPo.jpg"
            ]
          ],
          "id" => 1594353,
          "name" => "The Shield Hero",
          "overview" => "College student Iwatani Naofumi is reading a book titled \"The Records of the Four Cardinal Weapons\" in the library when he is suddenly summoned to another world and told he has to save the world as the Shield Hero, one of the Four Cardinal Heroes. And one morning, he finds all his money and equipment gone.",
          "season_number" => 1,
          "still_path" => "/fY3CFbtAmNEW0eaKUoqAJy0j1kb.jpg",
          "vote_average" => 5.6,
        ],
      ],
      "name" => "Season 1",
      "id" => 110814,
      "poster_path" => "/VSxgt1WBqkI1Wf65zQNiU32xHv.jpg",
      "season_number" => 1
    ], 200);
  }

  private function fakeTvInfo()
  {
    return Http::response([
      "id" => 83095,
      "original_name" => "盾の勇者の成り上がり",
      "name" => "The Rising of the Shield Hero",
      "backdrop_path" => "/qSgBzXdu6QwVVeqOYOlHolkLRxZ.jpg",
    ], 200);
  }
}

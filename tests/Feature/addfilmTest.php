<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class addfilmTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {

        $response = $this->get('create-film');

        $response->assertStatus(200);
        $filmData = [
            "name" => "fiml_1",
            "description"=>  "In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia\n",
            "release_date"=> "2023-07-19",
            "rating"=> 5,
            "ticket_price"=> 500,
            "country"=> "pakistan",
            "image"=> "photo.jpeg"
        ];

        $this->post('insert/movie', $filmData);
        $this->assertDatabaseHas('films', $filmData);
        $response->assertStatus(200);
    }
}

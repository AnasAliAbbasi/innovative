<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class filmdescriptionpageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $film = \App\Models\filmModel::find(1);
        if($film != null) {
            $response = $this->get('film/'.Crypt::encrypt('1'));
            $response->assertStatus(200);
        }else{
            echo "No Movie Inserted For Description";
    
        }


    }
}

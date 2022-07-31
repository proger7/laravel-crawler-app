<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{

    public function testBasic()
    {
        $this->assertTrue(true);
    }

    public function testRoute()
    {
    	$response = $this->post(route('manufacturer.download'))
    	->assertStatus(200);	
    }

	public function testUser()
	{
	    $users = factory('App\Models\User', 5)->create();
	    $response = $this->actingAs($users->first())->post(route('subcategory.download'));
	    $content = $response->streamedContent();
	    $this->assertIsString($content);
	}

    public function testRouteWithValue()
    {
        $this->post(route('subcategory.download'), ['Category type' => 'hersteller_category_carousel'])
             ->assertStatus(200)
             ->assertSuccessful();
    }

}

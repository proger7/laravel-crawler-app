<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainPageTest extends TestCase
{

    public function testPage()
    {
        $response = $this->get('/');
        $response->assertSee('Home');
        $response->assertStatus(200);
    }

    public function testTemplate()
    {
        $response = $this->get(route('home'));
        $response->assertSuccessful();
        $response->assertViewIs('welcome');
    }

    public function testParsePage()
    {
        $response = $this->get('/parse');
        $response->assertSee('Parse');
        $response->assertStatus(200);    
    }

    public function testConfPage()
    {
        $response = $this->get('/configurations');
        $response->assertSee('Configurations');
        $response->assertStatus(200);    
    }

    public function testLogsPage()
    {
        $response = $this->get('/logs');
        $response->assertSee('Logs');
        $response->assertStatus(200);    
    }

    public function testStatisticPage()
    {
        $response = $this->get('/statistics');
        $response->assertSee('Statistics');
        $response->assertStatus(200);    
    }

}

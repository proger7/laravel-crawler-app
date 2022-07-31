<?php

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogTest extends TestCase
{

    public function testBasicPage()
    {
        $response = $this->get('/logs');
        $response->assertStatus(200);
    }

    public function testGettingAllLogs()
    {
        $response = $this->json('GET', '/logs/all');
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                [
                	'id',
			    	'v_status',
			    	'n_parsed_qua',
			    	'v_url',
			    	'v_site_url',
			    	'v_content_type',
			    	'v_comment',
			    	'v_command'
                ]
            ]
        );
    }

    public function testDeleteLog()
    {
        $response = $this->json('GET', '/logs/all');
        $response->assertStatus(200);

        $item = $response->getData()[0];
        $delete = $this->json('DELETE', '/logs/delete/'.$item->id);
        $delete->assertStatus(200);
        $delete->assertJson(['fail' => false]);
    }

    public function testSearchLog()
    {
        $response = $this->json('GET', '/logs/all');
        $response->assertStatus(200);

        $search_data = (array)$response->getData()[0]; 
        $search = $this->json('POST', '/logs/search/', $search_data);
        $search->assertStatus(200);
        $search->assertJson(['success' => true]);
    }

    public function testDeleteAllLog()
    {
        $response = $this->json('GET', '/logs/all');
        $response->assertStatus(200);

        $item = $response->getData();
        $delete = $this->json('DELETE', '/logs/myproductsDeleteAll/');
        $delete->assertStatus(200);
        $delete->assertJson(['success'=>"Logs deleted successfully."]);  	
    }    

}

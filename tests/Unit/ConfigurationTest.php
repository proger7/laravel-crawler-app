<?php

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConfigurationTest extends TestCase
{

    public function testBasicPage()
    {
        $response = $this->get('/configurations');
        $response->assertStatus(200);
    }

    public function testGettingAllConfigurations()
    {
        $response = $this->json('GET', '/configurations/all');
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                [
                	'id',
			    	'v_url',
			    	'v_site_url',
			    	'v_content_type',
			    	'v_filter_type',
			    	'v_function',
			    	'created_at',
			    	'updated_at'
                ]
            ]
        );
    }

    public function testCreateConfiguration()
    {
        $data = [
                    'itemUrl' => "https://persik.com/kakapo",
                    'siteurl' => "https://persik.com",
                    'contenttype' => ".persik-pagination",
                    'filtertype' => "pagination",
                    'filterfunction' => "70_get_PersikListPagination"
                ];

        $response = $this->json('POST', '/configurations/create', $data);
        $response->assertStatus(200);
        $response->assertJson(['fail' => false]);
    }

    public function testUpdateConfiguration()
    {
        $response = $this->json('GET', '/configurations/all');
        $response->assertStatus(200);

        $data = [
                    'itemUrl' => "https://persik.com/kakapo",
                    'siteurl' => "https://persik.com",
                    'contenttype' => ".persik-pagination",
                    'filtertype' => "pagination",
                    'filterfunction' => "70_get_PersikListPagination"
                ];

        $conf = $response->getData()[0];
        $update = $this->json('PUT', '/configurations/update/'. $conf->id, $data);
        $update->assertStatus(200);
        $update->assertJson(['fail' => false]);
    }

    public function testDeleteConfiguration()
    {
        $response = $this->json('GET', '/configurations/all');
        $response->assertStatus(200);

        $item = $response->getData()[0];
        $delete = $this->json('DELETE', '/configurations/delete/'.$item->id);
        $delete->assertStatus(200);
        $delete->assertJson(['fail' => false]);
    }

    public function testSearchConfiguration()
    {
        $response = $this->json('GET', '/configurations/all');
        $response->assertStatus(200);

        $search_data = (array)$response->getData()[0]; 
        $search = $this->json('POST', '/configurations/search/', $search_data);
        $search->assertStatus(200);
        $search->assertJson(['success' => true]);
    }

    public function testDeleteAllConfiguration()
    {
        $response = $this->json('GET', '/configurations/all');
        $response->assertStatus(200);

        $item = $response->getData();
        $delete = $this->json('DELETE', '/configurations/myproductsDeleteAll/');
        $delete->assertStatus(200);
        $delete->assertJson(['success'=>"Configurations deleted successfully."]);  	
    }

   
}

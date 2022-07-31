<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Configurations;
use App\Logs;

class DatabaseTest extends TestCase
{

    public function testDatabaseConf()
    {
	    $this->assertDatabaseHas('configurations', [
	        'v_function' => '01_get_Page_Element',
	        'v_filter_type' => 'pagination',
	        'v_content_type' => '.paginate'
	    ]);
	    $this->assertDatabaseMissing('configurations', [
	        'v_function' => '77_get_Page_Images',
	        'v_filter_type' => 'pagination123',
	        'v_content_type' => '.paginate_123'
	    ]);
	    // $conf = new Configurations;
	    // $this->assertModelNotSoftDeleted($conf);
    }

    public function testDatabaseLog()
    {
	    $this->assertDatabaseHas('logs', [
	        'v_status' => 'Success',
	        'n_parsed_qua' => '6',
	        'v_content_type' => 'Category 1'
	    ]);
	    $this->assertDatabaseMissing('logs', [
	        'v_status' => 'Fail',
	        'n_parsed_qua' => '90',
	        'v_content_type' => 'Category 12'
	    ]);
	    // $log = new Logs;
	    // $this->assertModelNotSoftDeleted($log);
    }

    public function testDatabaseProduct()
    {
	    $this->assertDatabaseHas('products', [
	        'category_type' => 'product_category',
	        'category_name' => 'E-Zigaretten',
	        'image_size' => '600X600'
	    ]);
	    $this->assertDatabaseMissing('products', [
	        'category_type' => 'hersteller_category',
	        'category_name' => 'E-Zigaretten-and-Liquids',
	        'image_size' => '300X720'
	    ]);
    }

    public function testDatabaseCategory()
    {
	    $this->assertDatabaseHas('categories', [
	        'name' => 'E-Zigaretten',
	        'category_type' => 'product_category',
	    ]);
	    $this->assertDatabaseMissing('categories', [
	        'name' => 'E-Zigaretten-and-Liquids	',
	        'category_type' => 'hersteller_category',
	    ]);
    }

    public function testDatabaseManufacturer()
    {
	    $this->assertDatabaseHas('manufacturers', [
	        'category_type' => 'hersteller_category',
	    ]);
	    $this->assertDatabaseMissing('manufacturers', [
	        'category_type' => 'products_category',
	    ]);
    }

    public function testDatabaseUser()
    {
	    $this->assertDatabaseHas('users', [
	        'name' => 'persik1994',
	        'email' => 'quantumwise555@gmail.com',
	        'is_admin' => '1'
	    ]);
	    $this->assertDatabaseMissing('users', [
	        'name' => 'persik123',
	        'email' => 'quantumwise@gmail.com',
	        'is_admin' => '0'
	    ]);	
    }

    public function testDatabaseOAuthClients()
    {
	    $this->assertDatabaseHas('oauth_clients', [
	        'name' => 'Laravel Personal Access Client',
	        'personal_access_client' => '1',
	    ]);
	    $this->assertDatabaseMissing('oauth_clients', [
	        'name' => 'Laravel Access Client',
	        'personal_access_client' => '0',
	    ]);	    	
    }

}

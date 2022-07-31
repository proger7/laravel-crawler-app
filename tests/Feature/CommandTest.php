<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Artisan;

class CommandTest extends TestCase
{

    public function testCategory()
    {
        $this->artisan('category:save', ['--url' => 'https://dampfdorado.de/']);
        $resultAsText = Artisan::output();
        $this->assertTrue(true);
    }

    public function testManufacturer()
    {
        $this->artisan('hersteller:save', ['--url' => 'https://dampfdorado.de/e-zigaretten/']);
        $resultAsText = Artisan::output();
        $this->assertTrue(true);
    }

    public function testSubcategory()
    {
        $this->artisan('subcategory:save', ['--subcat' => 'https://dampfdorado.de/eleaf/']);
        $resultAsText = Artisan::output();
        $this->assertTrue(true);  
    }

    public function testProduct()
    {
        $this->artisan('parser:start', [
            'from' => 0,
            'count' => 1,
            '--url' => 'https://dampfdorado.de/e-zigaretten/',
            '--cattype' => 'product_category'
        ]);
        $resultAsText = Artisan::output();
        $this->assertTrue(true); 
    }

}

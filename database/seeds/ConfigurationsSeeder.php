<?php

use Illuminate\Database\Seeder;
use App\Configurations;

class Conf extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configurations = [

            [
                'v_url' => 'https://shop.highendsmoke.de/e-zigaretten/',
                'v_site_url' => 'https://shop.highendsmoke.de',
                'v_content_type' => '.content .img',
                'v_filter_type' => 'images',
                'v_function' => '50_Get_All_Images'
            ],
            [
                'v_url' => 'https://dampfdorado.de/e-zigaretten/',
                'v_site_url' => 'https://dampfdorado.de',
                'v_content_type' => 'div.total_count',
                'v_filter_type' => 'page',
                'v_function' => '60_Get_Total_Pages'
            ],
            [
                'v_url' => 'https://www.damfastore.de/antimatter/',
                'v_site_url' => 'https://www.damfastore.de',
                'v_content_type' => 'div a.tsk',
                'v_filter_type' => 'task',
                'v_function' => '70_Create_Task'
            ]

        ];

        foreach ($configurations as $configuration) {
            Configurations::create($configuration);
        }
    }
}

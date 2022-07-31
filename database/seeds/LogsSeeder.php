<?php

use Illuminate\Database\Seeder;
use App\Logs;

class Log extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $logs = [

            [
                'v_status' => 'Success',
                'n_parsed_qua' => 15,
                'v_url' => 'https://dampfdorado.de/e-zigaretten/',
                'v_site_url' => 'https://dampfdorado.de',
                'v_content_type' => 'Subcategory 1',
                'v_comment' => 'Parsing https://dampfdorado.de/e-zigaretten/ started. Filter .subcategory found',
                'v_command' => 'php artisan subcategory:save --subcat=https://dampfdorado.de/e-zigaretten/'
            ],
            [
                'v_status' => 'Error',
                'n_parsed_qua' => 0,
                'v_url' => 'https://shop.highendsmoke.de/e-zigaretten/',
                'v_site_url' => 'https://shop.highendsmoke.de',
                'v_content_type' => 'Image 1',
                'v_comment' => 'Parsing https://shop.highendsmoke.de/e-zigaretten/ not started. Filter not found in configuration table',
                'v_command' => 'php artisan hersteller:save --url=https://shop.highendsmoke.de/e-zigaretten/'
            ],
            [
                'v_status' => 'Success',
                'n_parsed_qua' => 10,
                'v_url' => 'https://www.damfastore.de/starter-set/',
                'v_site_url' => 'https://www.damfastore.de',
                'v_content_type' => 'Category 3',
                'v_comment' => 'Parsing https://www.damfastore.de/starter-set/ started. Filter .main_image found',
                'v_command' => 'php artisan parser:start 0 10 --url=https://www.damfastore.de/starter-set/ --cattype=product_category'
            ]

        ];

        foreach ($logs as $log) {
            Logs::create($log);
        }
    }
}

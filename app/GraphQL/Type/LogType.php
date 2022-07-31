<?php

namespace App\GraphQL\Type;

use App\Models\Logs;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class LogType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'log',
        'description'   => 'A log'
    ];

    public function fields(): array
    {
        return [
            'v_status' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'status of log',
            ],
            'n_parsed_qua' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'quantity of parsed logs',
            ],
            'v_url' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'url of log',
            ],
            'v_site_url' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'site url of log',
            ],
            'v_content_type' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'type of log',
            ],
            'v_comment' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'comment for log',
            ],
            'v_command' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'command of log',
            ],
        ];
    }
}
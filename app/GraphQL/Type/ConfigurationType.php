<?php

namespace App\GraphQL\Type;

use App\Models\Configurations;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ConfigurationType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'configuration',
        'description'   => 'A configuration'
    ];

    public function fields(): array
    {
        return [
            'v_url' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'category url',
            ],
            'v_site_url' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'site url',
            ],
            'v_content_type' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'type of content',
            ],
            'v_filter_type' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'type of filter',
            ],
            'v_function' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'filter function',
            ],
        ];
    }
}
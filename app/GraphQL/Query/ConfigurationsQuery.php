<?php

namespace App\GraphQL\Query;

use Closure;
use App\Models\Configurations;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class ConfigurationsQuery extends Query
{
    protected $attributes = [
        'name' => 'Configurations query'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Configuration'));
    }

    public function args(): array
    {

        return [
            'v_url'          => ['name' => 'v_url', 'type' => Type::string()],
            'v_site_url'     => ['name' => 'v_site_url', 'type' => Type::string()],
            'v_content_type' => ['name' => 'v_content_type', 'type' => Type::string()],
            'v_filter_type'  => ['name' => 'v_filter_type', 'type' => Type::string()],
            'v_function'     => ['name' => 'v_function', 'type' => Type::string()]
        ];

    }

    public function resolve($root, $args)
    {

        if (isset($args['v_url'])) {
            return Configurations::where('v_url', $args['v_url'])->get();
        }

        if (isset($args['v_site_url'])) {
            return Configurations::where('v_site_url', $args['v_site_url'])->get();
        }

        if (isset($args['v_content_type'])) {
            return Configurations::where('v_content_type' , $args['v_content_type'])->get();
        }

        if (isset($args['v_filter_type'])) {
            return Configurations::where('v_filter_type' , $args['v_filter_type'])->get();
        }

        if (isset($args['v_function'])) {
            return Configurations::where('v_function' , $args['v_function'])->get();
        }   

        return Configurations::all();
    }
}
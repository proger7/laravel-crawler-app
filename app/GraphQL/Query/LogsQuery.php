<?php

namespace App\GraphQL\Query;

use Closure;
use App\Models\Logs;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class LogsQuery extends Query
{
    protected $attributes = [
        'name' => 'Logs query'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Log'));
    }

    public function args(): array
    {

        return [
            'v_status'       => ['name' => 'v_status', 'type' => Type::string()],
            'n_parsed_qua'   => ['name' => 'n_parsed_qua', 'type' => Type::int()],
            'v_url'          => ['name' => 'v_url', 'type' => Type::string()],
            'v_site_url'     => ['name' => 'v_site_url', 'type' => Type::string()],
            'v_content_type' => ['name' => 'v_content_type', 'type' => Type::string()],
            'v_comment'      => ['name' => 'v_comment', 'type' => Type::string()],
            'v_command'      => ['name' => 'v_command', 'type' => Type::string()]
        ];

    }

    public function resolve($root, $args)
    {

        if (isset($args['v_status'])) {
            return Logs::where('v_status', $args['v_status'])->get();
        }

        if (isset($args['n_parsed_qua'])) {
            return Logs::where('n_parsed_qua', $args['n_parsed_qua'])->get();
        }

        if (isset($args['v_url'])) {
            return Logs::where('v_url' , $args['v_url'])->get();
        }

        if (isset($args['v_site_url'])) {
            return Logs::where('v_site_url' , $args['v_site_url'])->get();
        }

        if (isset($args['v_content_type'])) {
            return Logs::where('v_content_type' , $args['v_content_type'])->get();
        }

        if (isset($args['v_comment'])) {
            return Logs::where('v_comment' , $args['v_comment'])->get();
        }

        if (isset($args['v_command'])) {
            return Logs::where('v_command' , $args['v_command'])->get();
        }    

        return Logs::all();
    }
}
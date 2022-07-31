<?php

namespace App\GraphQL\Mutation;

use CLosure;
use App\Models\Configurations;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;

class UpdateConfigurationMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UpdateConfiguration',
        'description' => 'A mutation of configuration'
    ];

    public function type(): Type
    {
        return GraphQL::type('Configuration');
    }

    public function args(): array
    {
        return [
            'v_url'           => ['name' => 'v_url', 'type' => Type::string()],
            'v_site_url'      => ['name' => 'v_site_url', 'type' => Type::string()],
            'v_content_type'  => ['name' => 'v_content_type', 'type' => Type::string()],
            'v_filter_type'   => ['name' => 'v_filter_type', 'type' => Type::string()],
            'v_function'      => ['name' => 'v_function', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args)
    {
        $user = User::find($args['v_site_url']);
        if(!$user) {
            return null;
        }

        $user->email = $args['v_content_type'];
        $user->save();

        return $user;
    }
}
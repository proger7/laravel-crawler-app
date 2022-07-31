<?php

namespace App\GraphQL\Mutation;

use CLosure;
use App\Models\Logs;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;

class UpdateLogMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UpdateLog',
        'description' => 'A mutation of log'
    ];

    public function type(): Type
    {
        return GraphQL::type('Log');
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
        $user = User::find($args['n_parsed_qua']);
        if(!$user) {
            return null;
        }

        $user->email = $args['v_content_type'];
        $user->save();

        return $user;
    }
}
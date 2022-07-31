<?php

namespace App\GraphQL\Mutation;

use CLosure;
use App\Models\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;

class UpdateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UpdateUser'
    ];

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()],
            'email' => ['name' => 'email', 'type' => Type::string()],
            'password' => ['name' => 'password', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $user = User::find($args['email']);
        if(!$user) {
            return null;
        }

        $user->email = $args['email'];
        $user->save();

        return $user;
    }
}
<?php

use example\Type\ExampleType;
use example\Query\ExampleQuery;
use example\Mutation\ExampleMutation;
use example\Type\ExampleRelationType;


use App\Models\User;
use App\Models\Logs;

use App\GraphQL\Query\UsersQuery;
use App\GraphQL\Query\LogsQuery;
use App\GraphQL\Type\UserType;
use App\GraphQL\Type\LogType;
use App\GraphQL\Mutation\UpdateUserMutation;
use App\GraphQL\Mutation\UpdateLogMutation;

return [

    // The prefix for routes
    'prefix' => 'graphql',

    // The routes to make GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Route
    'routes' => '{graphql_schema?}',

    // The controller to use in GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Controller and method
    'controllers' => \Rebing\GraphQL\GraphQLController::class.'@query',

    // Any middleware for the graphql route group
    'middleware' => [],
    'route_group_attributes' => [],

    // The name of the default schema used when no argument is provided
    // to GraphQL::schema() or when the route is used without the graphql_schema
    // parameter.
    'default_schema' => 'default',

    'schemas' => [
        'default' => [
            'query' => [
                'users' => App\GraphQL\Query\UsersQuery::class,
                'logs' => App\GraphQL\Query\LogsQuery::class,
                'configurations' => App\GraphQL\Query\ConfigurationsQuery::class
            ],
            'mutation' => [
                'updateUser' => App\GraphQL\Mutation\UpdateUserMutation::class,
                'updateLog' => App\GraphQL\Mutation\UpdateLogMutation::class,
                'updateConfiguration' => App\GraphQL\Mutation\UpdateConfigurationMutation::class
            ],
            // 'middleware' => ['checkAccess']
        ],
    ],

    'types' => [
        'User' => App\GraphQL\Type\UserType::class,
        'Log' => App\GraphQL\Type\LogType::class,
        'Configuration' => App\GraphQL\Type\ConfigurationType::class
    ],

    // This callable will be passed the Error object for each errors GraphQL catch.
    // The method should return an array representing the error.
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],

    /*
     * Custom Error Handling
     *
     * Expected handler signature is: function (array $errors, callable $formatter): array
     *
     * The default handler will pass exceptions to laravel Error Handling mechanism
     */
    'errors_handler' => ['\Rebing\GraphQL\GraphQL', 'handleErrors'],

    // You can set the key, which will be used to retrieve the dynamic variables
    'params_key'    => 'variables',

    /*
     * Options to limit the query complexity and depth. See the doc
     * @ https://github.com/webonyx/graphql-php#security
     * for details. Disabled by default.
     */
    'security' => [
        'query_max_complexity'  => null,
        'query_max_depth'       => null,
        'disable_introspection' => false,
    ],

    /*
     * You can define your own pagination type.
     * Reference \Rebing\GraphQL\Support\PaginationType::class
     */
    'pagination_type' => \Rebing\GraphQL\Support\PaginationType::class,

    /*
     * Config for GraphiQL (see (https://github.com/graphql/graphiql).
     */
    'graphiql' => [
        'prefix'     => '/graphiql/{graphql_schema?}',
        'controller' => \Rebing\GraphQL\GraphQLController::class.'@graphiql',
        'middleware' => [],
        'view'       => 'graphql::graphiql',
        'display'    => env('ENABLE_GRAPHIQL', true),
    ],

    /*
     * Overrides the default field resolver
     * See http://webonyx.github.io/graphql-php/data-fetching/#default-field-resolver
     */
    'defaultFieldResolver' => null,

    /*
     * Any headers that will be added to the response returned by the default controller
     */
    'headers' => [],

    /*
     * Any JSON encoding options when returning a response from the default controller
     * See http://php.net/manual/function.json-encode.php for the full list of options
     */
    'json_encoding_options' => 0,
];
